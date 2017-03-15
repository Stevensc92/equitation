<?php

class AppModel
{
	public
		$table,
		$alias,
		$fields,
		$result,
		$route,
		$cache;


	private $keywords = ['NOW()'];
	/**
	*
	* Method __construct:
	* Init cache Model, clean route for re-using, init new table name;
	*
	* @param $route string ;
	*
	* @return empty;
	*
	**/

	public function __construct($route)
	{
		$this->cache = true;
		$this->route = Router::cleanRoute($route);
		$this->table = strtolower(get_called_class());
	}

	/**
	*
	* Method find:
	* Build sql request and execute it.
	*
	* @param $query object :
	*	- (array)          => fields
	*	- (array)          => join
	*	- (array)          => conditions
	*	- (string)         => order
	*	- (string)         => limit
	*	- (bool) | (array) => paginate
	*
	* @return array of results;
	*
	**/

	public function find($query)
	{
		if(isset($query->fields) && is_array($query->fields))
		{
			$fields = [];

			foreach($query->fields as $k => $v)
				$fields[] = !strstr($v, '.') ? get_class($this).'.'.$v : $v;

			$this->fields .= implode(', ', $fields);
		}

		if(isset($query->join))
		{
			foreach($query->join as $k => $v)
				if(is_array($k))
					foreach($v as $x => $y)
						$implode['key'] = $k.'.'.$x;


			$this->fields .= isset($query->fields)
							? ', '.$implode['key']
							: $this->table.'.*, '.$query->join[0].'.*';
		}

		$sql = 'SELECT '.(!empty($this->fields) ? $this->fields : $this->table.'.*').' FROM '.$this->table;


		if(isset($query->join))
		{
			foreach($query->join as $k => $v)
			{
				$implode = new Object();

				if(is_array($k))
				{
					foreach($v as $x => $y)
					{
						$implode->key   = $k.'.'.$x;
						$implode->value = $y;
					}

					$sql .= ' LEFT JOIN '.$k.' ON '.implode(' = ', (array) $implode);
				}
				else
				{
					$implode->key = get_class($this).'.parent_id';
					$implode->value = $query->join[0].'.id';

					$sql .= ' LEFT JOIN '.$query->join[0].' ON '.$implode->key.' = '.$implode->value;
				}
			}
		}

		if(isset($query->conditions))
		{
			$sql .= ' WHERE ';
			if(!is_array($query->conditions))
				$sql .= $query->conditions;
			else
			{
				$condition = [];

				foreach($query->conditions as $k => $v)
				{
					if(!is_numeric($v))
						$v = '\''.mysql_escape_string($v).'\'';

					$condition[] = $k.'='.$v;
				}

				$sql .= implode(' AND ', $condition);
			}
		}

		if(isset($query->order))
		{
			if(is_string($query->order))
			{
				list($field, $ord) = explode('.', $query->order);
				$sql .= ' ORDER BY '.$field.' '.$ord;
			}
			elseif(is_array($query->order))
			{
				$sql .= ' ORDER BY ';

				$order = [];

				foreach($query->order as $k => $v)
				{
					list($field, $ord) = explode('.', $v);
					$order[] = $field.' '.$ord;
				}

				$sql .= implode(', ', $order);
			}
		}

		if(isset($query->paginate))
		{
			$pages = Html::paginate(
				!empty($_GET['page']) ? $_GET['page'] : 1,
				count($this->exec($sql)),
				is_bool($query->paginate['model'])
					? $this->route.'?page=*'
					: $query->paginate['model'],
				isset($query->paginate['perPage'])
					? $query->paginate['perPage']
					: 30
			);

			$this->result = array_splice(
				$this->result,
				$pages['sub']['start'],
				$pages['sub']['end']
			);

			return ['result' => $this->result, 'pages' => $pages['xhtml']];
		}
		elseif(isset($query->limit))
		{
			if(strstr('OFFSET', $query->limit))
				$sql .= ' LIMIT '.$query->limit;
			else
				$sql .= ' LIMIT 0, '.$query->limit;
		}

		return $this->exec($sql);
	}



	/**
	*
	* Method FindFirst:
	* Build sql request and return first result.
	*
	* @param $fields array : fields for the condition
	* @param $id int : Null by default, if defined make default id condition.
	*
	* @return array of results;
	*
	**/

	public function FindFirst($fields, $id = null)
	{
		$query = new Object();
		$query->conditions = [];

		if(is_null($id))
			$query->conditions = $fields;
		else
			$query->conditions = ['id' => $id];

		return $this->find($query);
	}

	/**
	*
	* Method exec:
	* Exec query, return result and caching the data if needed.
	*
	* @param $query string : builded query.
	*
	* @return array of results;
	*
	**/

	public function exec($query)
	{
		if($this->cache == false)
			return $this->result = SQL::query($query)->fetchAll();
		else
		{
			$cache = new Cache(CACHE, 0);

			if(!$cache->read($this->table.'_'.md5($query)))
			{
				$this->result = $this->result = SQL::query($query)->fetchAll();
				$cache->write($this->table.'_'.md5($query), $this->result);
			}
			else
				$this->result = $cache->read($this->table.'_'.md5($query));

			return $this->result;
		}
	}

	public function remove($ids)
	{
		if(!empty($ids))
		{
			if(is_array($ids))
			{
				foreach($ids as $foo => $value)
					if(!is_numeric($value))
						return false;
			}

			$cond = 'id '.(is_array($ids) || count($ids) > 1 ? 'IN ('.implode(', ', $ids).')' : '= '.$ids);
			$sql  = 'DELETE FROM `'.$this->table.'` WHERE '.$cond;

			return SQL::exec($sql);
		}
	}


	public function edit($data, $id = null)
	{
		$sql = '';
		$fields = [];
		foreach($data as $k => $v)
		{
			if(!is_numeric($v) && !in_array($v, $this->keywords))
				$v = '\''.trim(mysql_escape_string($v)).'\'';

			$fields[] = $this->table.'.'.$k.'='.$v;
		}

		if(is_null($id))
		{
			$sql .= 'INSERT INTO `'.$this->table.'` SET ';
			$sql .= implode(', ', $fields);
		}
		else
		{
			if(!is_numeric($id))
				$id = $this->table.'.email = \''.trim(mysql_escape_string($id)).'\'';
			else
				$id = $this->table.'.id = '.abs((int)$id);

			$sql .= 'UPDATE `'.$this->table.'` SET ';
			$sql .= implode(', ', $fields);
			$sql .= ' WHERE '.$id;
		}

		$cache = new Cache(CACHE, 50000);
		$cache->clear();

		return SQL::exec($sql);
	}

	public function exists($field, $data)
	{
		if(!is_numeric($data))
			$data = '\''.trim(mysql_escape_string($data)).'\'';

		return
			SQL::query('
				SELECT COUNT('.$field.')
				FROM '.$this->table.'
				WHERE '.$field.' = '.$data.';'
			)->fetchColumn();
	}

	public function registerClass($class)
	{
		if(!empty($class) && !is_numeric($class) && file_exists(CONTROLLERS.DS.$class.'Controller.php'))
		{
			$class      = $class.'Controller';
			$reflection = new ReflectionClass($class);
			$instance   = $reflection->newInstanceWithoutConstructor();

			return $instance;
		}
	}

}

?>