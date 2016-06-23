<?

class Log 
{
    
    public $format_log = "Date: %s.  %s";
    protected $message = null;

    public function add($mess)
    {
        $this->message = $mess;
        $this->beforeAdd();
        $this->addMessage();
        $this->afterAdd();
    }

    protected function beforeAdd()
    {
        $this->message = sprintf($this->format_log, date("Y-m-d H:i:s"), $this->message) . PHP_EOL;
    }
    
    protected function addMessage() {}
    
    protected function afterAdd()
    {
    }
}


class FileLog extends Log
{
    protected $fl = null;
    public $format_log = "Date: %s. Message: %s\n";

    protected function beforeAdd()
    {
        parent::beforeAdd();
        if(!$this->fl)
            $this->fl = fopen(__DIR__ . '/../tmp/php.log', 'a');
    }

    protected function addMessage()
    {
        fwrite($this->fl, $this->message);
    }
    
    
}



?>
