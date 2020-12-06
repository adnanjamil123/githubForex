<?php
	
	Class DatabaseConfiguration
	{
		// data members //
		public $connection;
		private $servertype = "localhost", $username = "root", $password = "", $database = "onfinancialmarkets";
		
		// member functions //
		
			// constructor function //
			public function __construct()
			{	

				$this->connection = mysqli_connect($this->servertype, $this->username, $this->password, $this->database);
					
				if(!$this->connection)
				{
					echo "<h1>Connection Failed...</h1>";
				}
				
			}
			
			// data insert into database //
			public function query($query)
			{
				$data = mysqli_query($this->connection, $query);
				
				return mysqli_fetch_all($data, MYSQLI_NUM);
			}
			
			// data insert into database //
			public function insert($query)
			{
				mysqli_query($this->connection, $query);
				
			}

			// data delete into database //
			public function delete_query($query)
			{
				mysqli_query($this->connection, $query);
			}
			
			// data check into database //
			public function account_check($query)
			{
				$query_result = mysqli_query($this->connection, $query);
								
					if(mysqli_num_rows($query_result)>0)
					{
						return 1;
					}
					else
					{
						return 0;
					}

			}
			
			// data update into database //
			public function update($query)
			{
					mysqli_query($this->connection, $query);
			}
			
			public function __destruct()
			{	
				mysqli_close($this->connection);			
			}
		
	}
	
?>	