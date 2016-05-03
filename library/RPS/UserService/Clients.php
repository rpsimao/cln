<?php
/**
 * Classe para autenticação
 * @author rpsimao
 *
 */
class RPS_UserService_Clients extends Zend_Controller_Action_Helper_Redirector
{

    /**
     * Autentica username/password
     * @param array $credentials
     */
    
    protected $path;
    
    protected $id;

    protected $passwd;

    protected $table;

    protected $column_id;

    protected $column_credential;

    protected $time;


    /**
     * set The username
     * @param $id
     */
    public function setIdentity($id)
    {
        $this->id = $id;

    }

    /**
     * get The username
     * @return mixed
     */
    private function getIdentity()
    {
        return $this->id;
    }


    /**
     * set The username column
     * @param $id
     */
    public function setIdentityColumn($column_id)
    {
        $this->column_id = $column_id;

    }

    /**
     * get The username column
     * @return mixed
     */
    private function getIdentityColumn()
    {
        return $this->column_id;
    }


    /**
     * set the passwd
     * @param $passd
     */
    public function setCredentialColumn($column_credential)
    {
        $this->column_credential = $column_credential;
    }

    /**
     * get the passwd
     * @return mixed
     */
    private function getCredentialColumn()
    {
        return $this->column_credential;
    }


    /**
     * set the passwd
     * @param $passd
     */
    public function setCredential($passd)
    {
        $this->passwd = $passd;
    }

    /**
     * get the passwd
     * @return mixed
     */
    private function getCredential()
    {
        return $this->passwd;
    }

    /**
     * set the table name
     * @param $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * get the table name
     * @return mixed
     */
    private function getTable()
    {
        return $this->table;
    }

    /**
     * set Redirector
     * @param $path
     */
    public function setURL($path)
    {
        $this->path = $path;
    }

    /**
     * Get Redirector
     * @return mixed
     */
    private function _getURL()
    {
        return $this->path;
    }

    /**
     * set the default time in seconds session expire
     * @param int $time
     */

    public function setDefaultSessionTime($time = 1800){

        $this->time = $time;

    }


    private function getDefaultSessionTime()
    {
        return $this->time;
    }
    
    public function authenticate()
    {
        $filterValues = new Zend_Filter_StripTags();
        $username = $filterValues->filter($this->getIdentity());
        $password = $filterValues->filter($this->getCredential());
        //Define qual o nome da tabela de autenticação, e os campos de nome e palavra passe
        
        $authAdapter = new RPS_Authenticate_Login($this->getTable(), $this->getIdentityColumn(), $this->getCredentialColumn());
        
        //Define as credenciais de autenticação
        $authAdapter->setCredentials($username, $password);
        //Apanha os dados de autenticação
        $params = $authAdapter->getAuthenticationParameters();
        //Compara os dados de autenticação da base de dados com os inseridos pelo utilizador
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($params);
        //Se o resultado for válido, escreve em memória os dados do utilizador, EXCEPTO a password
        switch ($result->getCode()) {
            //Utilizador inexistente
            case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
            case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:

            $this->_redirect("/");
            break;
            //Autenticado redireciona para o controlador que se pretende
            case Zend_Auth_Result::SUCCESS:
                $data = $params->getResultRowObject(NULL, 'password');
                $auth->getStorage()->write($data);
                $salt = uniqid();
                $s = new Zend_Session_Namespace(Zend_Auth::getInstance()->getStorage()->getNamespace().$salt);
                $s->setExpirationSeconds($this->getDefaultSessionTime());
                $this->_redirect($this->_getURL());
                break;
                
          
        }
    }

    

    
    
    private function getEnv()
    {
        $application = new Zend_Application(getenv('APPLICATION_ENV'));
        $bootstrap = $application->getBootstrap();
        $env = $bootstrap->getEnvironment();
        return $env;
    }
}