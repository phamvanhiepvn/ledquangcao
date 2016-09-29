<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of MY_Model
 *
 * @author Nhattay
 */
class MY_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }


    public function getField_array($table, $field,$where=null)
    {
        $this->db->select($field);
        if($where!=null){
            $this->db->where($where);
        }

        $q = $this->db->get($table);
        return $q->result_array();
    }
    public function Update_where($table, $where, $data)
    {
        if (isset($data) && $data != NULL) {
            $this->db->where($where);
            $this->db->update($table, $data);
        }
    }
    public function Get_where($table, $where_array)
    {
        if ($table && is_array($where_array)) {
            $this->db->where($where_array);
        } else {
            return false;
        }

        $q = $this->db->get($table);
        return $q->result();
    }
    public function Delete_where($table,$where)
    {
        if ($table&&$where) {
            $this->db->where($where);
            $this->db->delete($table);
        } else return false;
    }
    public function getFirstRowWhere($table,$where=array())
    {
        if ($table && is_array($where)) {
            $this->db->where($where);
        } else {
            return false;
        }
        $q = $this->db->get($table);
        return $q->first_row();
    }
    public function SelectMax($table, $col)
    {
        if (($table && $col)) {
            $this->db->select_max($col);

            return $this->db->get($table)->first_row()->$col;
        } else return false;
    }
    public function GetData($table, $where = null,$order=null, $limit = null, $offset = null)
    {
        if (is_array($where)) {
            $this->db->where($where);
        }

        if ($limit || $offset) {
            $this->db->limit($limit, $offset);
        }
        if (is_array($order)) {
            $this->db->order_by($order[0],$order[1]);
        }

        $q = $this->db->get($table);
        return $q->result();
    }
    public function GetData2($table, $where = null,$order=null, $limit = null, $offset = null)
    {
        if (!is_array($where)||$where==null) {
            return array();
        }
        $this->db->like($where);
        if ($limit || $offset) {
            $this->db->limit($limit, $offset);
        }
        if (is_array($order)) {
            $this->db->order_by($order[0],$order[1]);
        }

        $q = $this->db->get($table);
        return $q->result();
    }
    public function getLikedPro($in){
        if(is_array($in)){
            $this->db->select('*');
            $this->db->where_in('id',$in);
            $n=$this->db->get('product');
            return $n->result();
        }else return array();

    }
    public function getSlider_partners(){
        $this->db->where('type','partners');
        $q=$this->db->get('images');
        return $q->result();
    }
//========================================================================================================




//Get_multi_table('table_name',where_array=aray( 'collum'=>'conditional'),join_array=array( array( ), array( ),.....))
    public function Get_multi_table($table, $where_array, $join_array)
        {

            foreach ($join_array as $v) {

                if (is_array($v)) {

                    $this->db->join($v[0], $v[2] . "." . $v[3] . "=" . $v[0] . "." . $v[1], $v[4]);

                } else {
                    return false;
                }
            }


            if ($table && is_array($where_array)) {

                $this->db->where($where_array);
            } else {
                return false;
            }

            $q = $this->db->get($table);

            return $q->result();
//        return $this->db->last_query();

        }

    public function getBanner($type){
        $this->db->select('*');
        $this->db->where('type',$type);
        $q = $this->db->get('images');
        return $q->result();
    }
    public function Count($table, $where = array())
    {
        $q = $this->db->select('*')
            ->from($table)
            ->where($where)
            ->get();
        return $q->num_rows();
    }
    public function Count2($table, $where = null)
    {
        if($where==null || !is_array($where)){
            return 0;
        }
        $this->db->select('*');
        $this->db->from($table);

        $this->db->like($where);
        $q= $this->db->get();
        return $q->num_rows();
    }
//==================================
    public function getAdminAcc($id){

        if($id){
            $this->db->select('id,username,username,email,lastlogin,level');
            $this->db->where('id',$id);
            $q = $this->db->get('admin');
            return $q->first_row();
        }else return false;
    }

    public function getUserModules($admin_id){
        if($admin_id){
              $this->db->where('user_id',$admin_id);
            $q = $this->db->get('user_modules');
            return $q->first_row();
        }else return false;
    }

    public function listAll($table, $limit=null, $offset=null)
    {
        $this->db->select('*');
        if($limit&&$offset){
            $this->db->limit($limit, $offset);
        }

        $this->db->order_by('id', 'desc');
        $q = $this->db->get($table);
        return $q->result();
    }

    public function getList($table)
    {
        $this->db->select('*');
        $q = $this->db->get($table);
        return $q->result();
    }

    public function count_All($table)
    {
        return $this->db->count_all($table);
    }

    public function getItemByID($table, $id)
    {
        $this->db->where('id', $id);
        $q = $this->db->get($table);
        return $q->first_row();
    }

    public function getItemByAlias($table, $alias)
    {
        $this->db->where('alias', $alias);
        $q = $this->db->get($table);
        return $q->first_row();
    }

    public function getFirstRow($table)
    {
        $q = $this->db->get($table);
        return $q->first_row();
    }

    public function getWhere($table, $col, $where)
    {
        $this->db->where($col, $where);
        $q = $this->db->get($table);
        return $q->first_row();
    }

    public function Add($table, $data)
    {
        if (isset($data) && $data != NULL) {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }

    public function Update($table, $id, $data)
    {
        if (isset($data) && $data != NULL) {
            $this->db->where('id', $id);
            $this->db->update($table, $data);
        }
    }



    public function Delete($table, $id)
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            $this->db->delete($table);
        } else return false;
    }
    public function DeleteTable($table)
    {
        $this->db->empty_table($table);
    }



//    test



}

?>
