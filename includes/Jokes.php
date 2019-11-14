<?php
define("DATA",__DIR__."/../data/jokes.json");

class Jokes
{
    private $_jokes                             = array();
    function                    __construct                         () {
        $array = json_decode(file_get_contents(DATA),true);
        foreach ($array as $v) {

            $joke = new Joke($v['question'],$v['punchline']);
            $this->_jokes[] = $joke;
        }


    }
    function                    get_random_jokes                    ($num = 1) {
        if (!$num)                              { $num = 1; }

        $returned                               = array();
        $to_return                              = array();
        if ($num >= count($this->_jokes)) {
            foreach ($this->_jokes as $j) {
                $to_return[]                    = $j;
            }
            return $to_return;
        }

        if ($num != 0) {
            $ret = 0;
            while ($ret < $num) {
               $ready_ret = false;

               while (!$ready_ret) {
                   $rand = rand(1,count($this->_jokes));
                   if (!$returned[$rand]) {
                       $to_return[] = $this->_jokes[$rand-1];
                       $returned[$rand] = true;
                       $ready_ret = true;
                       $ret++;

                   }
               }

            }
        }

        return $to_return;

    }
    function                    get_number_jokes() {
        return count($this->_jokes);
    }
}

class Joke
{
    private $_question                          = null;
    private $_punchline                         = null;
    function                    __construct                         ($question = null, $punchline = null)
    {
        $this->_question                        = $question;
        $this->_punchline                       = $punchline;
    }
    function                    question                            () {
        return $this->_question;
    }
    function                    punchline                           () {
        return $this->_punchline;
    }
    function to_Array() {
        return ['question'=>$this->_question,'punchline'=>$this->_punchline];
    }
    function                    json                                () {
        $json = array();
        $json['question'] = $this->_question;
        $json['punchline'] = $this->_punchline;
        return json_encode($json);
    }
}