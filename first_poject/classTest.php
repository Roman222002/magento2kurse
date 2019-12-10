<?php


require './publication.php';
$a = new first_project\publication();
$a->printText('Hello!');
 class publication{
    protected function printPub(){
        echo '<br>';
    }
    public function onPrint(){
        $this->printPub();
    }
}

class news extends publication{
    protected function printPub()
    {
        echo 'news';
    }
}
$tt = new publication();
$tt->onPrint();
$t=new news();
$t->onPrint();
