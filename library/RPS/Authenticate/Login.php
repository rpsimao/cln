<?php
/**
 * Classe de Autenticação de Utilizadores
 * 
 * @author Ricardo Simão
 * 
 * @version 1.0
 *
 */

class RPS_Authenticate_Login {


	/**
	 * User credentials
	 * @var array
	 */
	protected $_credentials;
	/**
	 * O nome da tabela 
	 * 
	 * @var string
	 */
	protected $_tableName;
	
	/**
	 * The username
	 * 
	 * @var string
	 */
	protected $_tableIdentity;
	
	/**
	 * The password
	 * @var string
	 */
	protected $_tableCredential;
	
	/**
	 * Define o nome da tabela onde estão as credenciais de autenticação
	 * Define qual o nome da coluna de utilizador e de palavra passe
	 *
	 * @param string $_tableName
	 * @param string $_tableIdentity
	 * @param string $_tableCredential
	 */
	
	function __construct($_tableName, $_tableIdentity, $_tableCredential) {
		$this->_tableName = $_tableName;
		$this->_tableIdentity = $_tableIdentity;
		$this->_tableCredential = $_tableCredential;
	}
	
	/**
	 * Define os valores de utilizador e de palavra passe
	 *
	 * @param string $_username
	 * @param string $_password
	 * @return array
	 */
	public function setCredentials($_username, $_password) {
		return $this->_credentials = array ($_username, $_password );
	}
	/**
	 * Recupera os valores de utilizador e de palavra passe
	 * 
	 * @return array
	 */
	public function getCredentials() {
		return $this->setCredentials ( $this->_credentials [0], $this->_credentials [1] );
	}
	
	/**
	 * Define os parametros de autenticação
	 *
	 * @return Zend_Auth_Adapter_DbTable
	 */
	private function setAuthenticationParameters() {
		
		$authAdapter = new Zend_Auth_Adapter_DbTable ();
		$authAdapter->setTableName ( $this->_tableName );
		$authAdapter->setIdentityColumn ( $this->_tableIdentity )
					->setCredentialColumn ( $this->_tableCredential )
					->setIdentity ( $this->_credentials [0] )
					->setCredential ( $this->_credentials [1] );
		return $authAdapter;
	}
	/**
	 * Recupera os valores de autenticação
	 * 
	 * @return Zend_Auth_Adapter_DbTable
	 */
	public function getAuthenticationParameters() {
		return $this->setAuthenticationParameters ();
	}

}