<?php
/**
 * PHPSense Pagination Class
 *
 * PHP tutorials and scripts
 *
 * @package     PHPSense
 * @author      Jatinder Singh Thind
 * @copyright   Copyright (c) 2006, Jatinder Singh Thind
 * @link        http://www.phpsense.com
 * @modification        José Loayza
 * @link                https://www.facebook.com/jloayzac
 */
 
// ------------------------------------------------------------------------
 
class PS_Pagination {
    private $php_self;
    private $rows_per_page = 10; 
    private $total_rows = 0; 
    private $links_per_page = 15; 
    private $append = ""; 
    private $sql = "";
    private $debug = false;
    private $conn = false;
    private $page = 1;
    private $max_pages = 0;
    private $offset = 0;
     

     
    function __construct($connection, $sql, $rows_per_page = 10, $links_per_page = 15, $append = "") {
        $this->conn = $connection;
        $this->sql = $sql;
        $this->rows_per_page = (int)$rows_per_page;
        if (intval($links_per_page ) > 0) {
            $this->links_per_page = (int)$links_per_page;
        } else {
            $this->links_per_page = 5;
        }
        $this->append = $append;
        $this->php_self = htmlspecialchars($_SERVER['PHP_SELF'] );
        if (isset($_GET['page'] )) {
            $this->page = intval($_GET['page'] );
        }
    }

    function paginate() {
                 
         

        $all_rs = $this->conn->prepare( $this->sql );
        $all_rs->execute();
         
        if (! $all_rs) {
            if ($this->debug)
                echo "SQL query fallido. Revisa tu query.<br /><br />Error Retornado: " . pg_last_error();
            return false;
        }
        $this->total_rows = $all_rs->rowCount();
         
        if ($this->total_rows == 0) {
            if ($this->debug)
                echo "Query retorna cero filas.";
            return FALSE;
        }

        $this->max_pages = ceil($this->total_rows / $this->rows_per_page );
        if ($this->links_per_page > $this->max_pages) {
            $this->links_per_page = $this->max_pages;
        }
         

        if ($this->page > $this->max_pages || $this->page <= 0) {
            $this->page = 1;
        }

        $this->offset = $this->rows_per_page * ($this->page - 1);

        $query = $this->sql . " LIMIT {$this->rows_per_page} OFFSET {$this->offset}";

        $rs = $this->conn->prepare( $query );
        $rs->execute();
         
        if (! $rs) {
            if ($this->debug)
                echo "Paginación query fallido. Revisa tu query.<br /><br />Error Returned: " . pg_last_error();
            return false;
        }

        return $rs;
    }
     

    function renderFirst($tag = 'First') {
        if ($this->total_rows == 0)
            return FALSE;
         
        if ($this->page == 1) {
            return "$tag ";
        } else {

            return " <a href='javascript:void(0);' OnClick='getdata( 1 )' title='First'>$tag</a> ";
        }
    }
     

    function renderLast($tag = 'Last') {
        if ($this->total_rows == 0)
            return FALSE;
         
        if ($this->page == $this->max_pages) {
            return $tag;
        } else {

            $pageno = $this->max_pages;
            return " <a href='javascript:void(0);' OnClick='getdata( $pageno )' title='Last'>$tag</a> ";
        }
    }
     

    function renderNext($tag = '&gt;&gt;') {
        if ($this->total_rows == 0)
            return FALSE;
         
        if ($this->page < $this->max_pages) {
              $pageno = $this->page + 1;
            return " <a href='javascript:void(0);' OnClick='getdata( $pageno )' title='Previous'>$tag</a> ";
        } else {
            return $tag;
        }
    }
     
    
    function renderPrev($tag = '&lt;&lt;') {
        if ($this->total_rows == 0)
            return FALSE;
         
        if ($this->page > 1) {
            $pageno = $this->page - 1;
            return " <a href='javascript:void(0);' OnClick='getdata( $pageno )' title='Anterior'>$tag</a> ";
        } else {
            return " $tag ";
        }
    }
     

    function renderNav($prefix = '<span class="page_link">', $suffix = '</span>') {
        if ($this->total_rows == 0)
            return FALSE;
         
        $batch = ceil($this->page / $this->links_per_page );
        $end = $batch * $this->links_per_page;
        if ($end == $this->page) {

        }
        if ($end > $this->max_pages) {
            $end = $this->max_pages;
        }
        $start = $end - $this->links_per_page + 1;
        $links = '';
         
        for($i = $start; $i <= $end; $i ++) {
            if ($i == $this->page) {
                $links .= $prefix . " $i " . $suffix;                                       
            } else {
                $links .= " <a href='javascript:void(0);' OnClick='getdata( $i )' title='Otra página'>$i</a> ";
            }
        }
         
        return $links;
    }
     

    function renderFullNav() {

        return $this->renderFirst() . '&nbsp;' . $this->renderPrev() . '&nbsp;' . $this->renderNav() . '&nbsp;' . $this->renderNext() . '&nbsp;' . $this->renderLast();
    }
     

    function setDebug($debug) {
        $this->debug = $debug;
    }
}
?>
