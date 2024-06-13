<?php
function q($Sql){
  $dsn = "mysql:host=localhost;charset=utf8;dbname=db991";
  $pdo = new PDO($dsn, 'root', '');
    return $pdo->queery($sql)->fetchAll(PDO::FETCH_ASSOC);
                                        //PDO::FETCH_ASSOC 依照結果集中傳回的直欄名稱，傳回已編製索引的陣列

}

function dd($array){
    echo "<pre>";
    print_r ($array);
    echo "</pre>";
}

function to($url){
    header("location:".$url);
}

public function all(...$arg)
{
    $sql = " select * from  `$this->table` ";

    // isset() 檢查的變數存不存在；empty()檢查的變數內的值是否為空。。。故一般判斷式常用 !empty()
    // 此處使用isset而非empty，是因empty捉不到0
    if (isset($arg[0])) {
        // 檢查變數是否為陣列
        if (is_array($arg[0])) {
            $tmp = $this->a2s($arg[0]);
            $sql .= " where " . join(" && ", $tmp);
        } else {
            $sql .= $arg[0];
        }
    }

    if (isset($arg[1])) {
        $sql .= $arg[1];
    }
    //echo $sql;

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


    // 限只餵array或id
    public function find($arg)
    {
        $sql = "select * from `$this->table` ";
        if (is_array($arg)) {
            $tmp = $this->a2s($arg);
            $sql .= " where " . join(" && ", $tmp);
        } else {
            $sql .= " where `id`='$arg'";
        }
        //echo $sql;

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    
        // del(2); 丟id
        // del([=>]);
    }

    // 限只餵array
    public function save($arg)
    {
        if (isset($arg['id'])) {    //update
            
            $tmp = $this->a2s($arg);
            $sql = "update `$this->table` set " . join(",", $tmp);
            $sql .= " where `id`='{$arg['id']}'";


        } else {                    //insert
           
            // array_keys()
            $keys = array_keys($arg);
            $sql = "insert into `$this->table` (`" . join("`,`", $keys) . "`) 
                   values('" . join("','", $arg) . "')";
        }

        return $this->pdo->exec($sql);
    }

    public function del($arg)
    {
        $sql = "delete from `$this->table` ";
        if (is_array($arg)) {
            $tmp = $this->a2s($arg);
            $sql .= " where " . join(" && ", $tmp);
        } else {
            $sql .= " where `id`='$arg'";
        }

        
        return $this->pdo->exec($sql);  //exec()
    }

    public function count($arg)
    {
        $sql = "select count(*) from  `$this->table`";

        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->a2s($arg[0]);
                $sql .= " where " . join(" && ", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        //echo $sql;

        return $this->pdo->query($sql)->fetchColumn();
    }


protected function a2s($array){
    $tmp=[];
    foreach($array as $key => $value){
        $tmp[]= " `$key` = '$value' ";
        return $tmp;
    }
}


?>