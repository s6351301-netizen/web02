<?php
session_start();

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db12";
    protected $pdo;
    protected $table;
    public function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    function all(...$arg){
        $sql="select * from $this->table";        
            if(isset($arg[0])){
                if(is_array($arg[0])){
                $where=$this->array2sql($arg[0]);
                $sql .=" where ".join(" AND ",$where);
                } else{
                $sql.=$arg[0];
                }
            }
            if (isset($arg[1])) {
                $sql .=$arg[1];
            }
            //echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    

    function find($id){
    $sql="select * from $this->table";        
            if(is_array($arg[0])){
                $where=$this->array2sql($arg[0]);
                $sql .=" where ".join(" AND ",$where);
                } else{
                $sql.="where `id`='{$id}'";
                }
            }
            //echo $sql;    
    
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    

    function save($array){
        if(isset($array['id'])){
            //update    
            $set=$this->array2sql($array);
            $sql="update $this->table set ".join(",",$set)." where `id`='{$array['id']}'";
        }else{
            //insert
            $cols=array_keys($array);
            $sql="insert into $this->table (`".join("`,`",$cols)."`) values ('".join("','",$array)."')";    
        }

        echo $sql; //測試用 呼叫SAVE方法時會印出SQL語法，確認是否正確
        return $this->pdo->exec($sql);//不需要回傳資料給我
    }



    function del($id){
        $sql="delete from $this->table";        
            if(is_array($arg[0])){
                $where=$this->array2sql($arg[0]);
                $sql .=" where ".join(" AND ",$where);
                } else{
                $sql.="where `id`='{$id}'";
                }
        return $this->pdo->exec($sql);//不需要回傳資料給我
            }    
    
        
    

    function count($arg){
    $sql="select count(*) from $this->table";        
            if(isset($arg[0])){
                if(is_array($arg[0])){
                $where=$this->array2sql($arg[0]);
                $sql .=" where ".join(" AND ",$where);
                } else{
                $sql.=$arg[0];
                }
            }
            if (isset($arg[1])) {
                $sql .=$arg[1];
            }
            //echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }

    function sum($col,...$arg){ 
        $sql="select sum(`$col`) from $this->table";        
            if(isset($arg[0])){
                if(is_array($arg[0])){
                $where=$this->array2sql($arg[0]);
                $sql .=" where ".join(" AND ",$where);
                } else{
                $sql.=$arg[0];
                }
            }
            if (isset($arg[1])) {
                $sql .=$arg[1];
            }
        return $this->pdo->query($sql)->fetchColumn();
    }   


    private function array2sql($array){
        $tmp=[];
        foreach($array as $key => $value){
            $tmp[]="`$key`='$value'";
        }
        return $tmp;      
    }    
}

function to($url){
    header("location:$url");
}

function q($sql){
    $dsn="mysql:host=localhost;charset=utf8;dbname=db12";
    $pdo=new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOCE);
}

$total=new DB('total');

$total->save(['date'=>date("Y-m-d"),'total'=>0]);

?>