<?php
declare (strict_types = 1);

Class Gerimas {

    private $data;

    public function __construct($data = null) {
        if (!$data) {
            $this->data = [
                'name' => null,
                'amount_ml' => null,
                'abarot' => null
            ];
        } else {
            $this->setData($data);
        }
    }

    public function setName(string $name) {
        $this->data['name'] = $name;
    }

    public function setAmount(int $amount) {
        $this->data['amount_ml'] = $amount;
    }

    public function setAbarot(float $abarot) {
        $this->data['abarot'] = $abarot;
    }

    public function getName() {
        return $this->data['name'];
    }

    public function getAmount() {
        return $this->data['amount_ml'];
    }

    public function getAbarot() {
        return $this->data['abarot'];
    }

    public function setData(array $data) {
        $this->setName($data['name'] ?? null);
        $this->setAmount($data['amount'] ?? null);
        $this->setAbort($data['abort'] ?? null);
    }

    public function getData() {
        return $this->data;
    }

}

Class FileDb {

    private $file_uri;
    private $data;

    public function __construct($file_uri) {
        $this->file_uri = $file_uri;
        $this->data = null;
        $this->load();
    }

    public function setRow($table, $row_id, $row_data) {
        $this->data[$table][$row_id] = $row_data;
    }

    public function setRowColumn($table, $row_id, $column_id, $column_data) {
        $this->data[$table][$row_id][$column_id] = $column_data;
    }

    public function getRow($table, $row_id) {
        return $this->data[$table][$row_id];
    }

    public function getRowColumn($table, $row_id, $column_id) {
        return $this->data[$table][$row_id][$column_id];
    }

    public function load() {
        if (!file_exists($this->file_uri)) {
            $this->data = [];
        } else {
            $json_data = file_get_contents($this->file_uri);
            $this->data = json_decode($json_data, true);
        }
    }

    public function save() {
        $data_json = json_encode($this->data);
        if (file_put_contents($this->file_uri, $data_json)) {
            return true;
        } else {
            throw new Exception('Neisejo issaugoti i faila.');
        }
    }

}

Class ModelGerimai {

    public function __construct(FileDb $db, $table_name) {
        
    }
}
?>
<html>
    <head>
        <title>OOP</title>
    </head>
    <body>

    </body>
</html>