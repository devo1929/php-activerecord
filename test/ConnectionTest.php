<?
include 'helpers/config.php';

// Only use this to test static methods in Connection that are not specific
// to any database adapter.

class ConnectionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException ActiveRecord\DatabaseException
	 */
	public function testConnectionInfoFromShouldThrowExceptionWhenNoHost()
	{
		ActiveRecord\Connection::connection_info_from('mysql://user:pass');
	}

	/**
	 * @expectedException ActiveRecord\DatabaseException
	 */
	public function testConnectionInfoFromShouldThrowExceptionWhenNoPath()
	{
		ActiveRecord\Connection::connection_info_from('mysql://user:pass@127.0.0.1');
	}

	public function testConnectionInfo()
	{
		$info = ActiveRecord\Connection::connection_info_from('mysql://user:pass@127.0.0.1:3306/dbname');
		$this->assertEquals('mysql',$info->protocol);
		$this->assertEquals('user',$info->user);
		$this->assertEquals('pass',$info->pass);
		$this->assertEquals('127.0.0.1',$info->host);
		$this->assertEquals(3306,$info->port);
		$this->assertEquals('dbname',$info->db);
	}
}
?>