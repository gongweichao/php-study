<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/5
 * Time: 14:39
 */

/**
 * Class html
 * 抽象一个html类
 */
abstract class html
{
    abstract public function makestyle();
    abstract public function maketigs();

    abstract public function output();


}

class tig extends html
{
    public $tigs;
    public $style ='';
    public function __construct($tig)
    {
        $this->tigs =$tig;
    }

    public function makestyle()
    {
        return $this->style;
    }
    public function maketigs()
    {
        return $this->tigs;
    }
    public function output()
    {
       return '<'.$this->maketigs().' style ="'.$this->makestyle().'"></'.$this->maketigs().'>';
    }

}

abstract class decorator extends html
{
    protected $html =  null;
    public function __construct(html $html)
    {
        $this->html =$html;
    }
}

class addcolor extends  decorator
{
    protected  $color;
    public function __construct(html $html,$color)
    {
        parent::__construct($html);
       $this->color=$color;

    }

    public function makestyle()
    {
        return $this->html->makestyle().' background-color:'.$this->color.';';
    }
    public function maketigs()
    {
        return $this->html->maketigs();
    }
    public function output()
    {
        return '<'.$this->maketigs().' style ="'.$this->makestyle().'"></'.$this->maketigs().'>';
    }
}

class addsize extends  decorator
{
    protected  $width;
    protected $height;
    public function __construct(html $html,$width,$height)
    {
        parent::__construct($html);
       $this->width =$width;
       $this->height = $height;
    }

    public function makestyle()
    {

        return $this->html->makestyle().' width:'.$this->width.';height:'.$this->height.';';
    }
    public function maketigs()
    {
        return $this->html->maketigs();
    }
    public function output()
    {
        return '<'.$this->maketigs().' style ="'.$this->makestyle().'"></'.$this->maketigs().'>';
    }
}




$div = new tig('div');
$div = new addcolor($div,'red');
$div = new addsize($div,'200px','200px');
echo $div ->output();