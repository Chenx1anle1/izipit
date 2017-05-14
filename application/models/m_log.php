<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_log extends CI_Model {
    /**
     * 获取日志列表
     * @access public
     * @param  integer $offset 查询偏移量
     * @param  integer $limit 查询数量
     * @param  array $condition 查询条件
     * @return array
     */
    public function get_list($offset = 0, $limit = 15, $condition = array()) {
        $condition && $this->db->where($condition);
        return $this->db->order_by('id desc')
                        ->limit($limit, $offset)
                        ->get('log')->result_array();
    }

    /**
     * 根据 id 获取日志数据
     * @access public
     * @param  integer $id 日志 id
     * @return array
     */
    public function get_one($id = 0) {
        return $this->db
                    ->where('id', $id)
                    ->get('log')
                    ->row_array();
    }

    public function count($condition = array()) {
        return $this->db->from('log')
                        ->where($condition)
                        ->count_all_results();
    }

    /**
     * 新增日志
     * @access public
     * @param  array $post 日志数据
     * @return boolean
     */
    public function log($level = '', $field = '', $model = '', $param = '') {
        $post = array();

        $post['level'] = $level;
        $post['field'] = $field;

        $RTR =& load_class('Router', 'core');
        $post['file'] = 'controllers/' . $RTR->fetch_directory() . $RTR->fetch_class() . '.php';
        $post['action'] = ucfirst($RTR->fetch_class()) . '::' . $RTR->fetch_method();
        $post['method'] = $RTR->fetch_method();
        $post['param'] = $param;

        $post['model'] = $model;
        $post['querystring'] = $this->db->last_query();
        // $post['data'] = $data;

        $post['ip'] = $this->input->ip_address();
        $post['time'] = time();
        if( $this->session->userdata('online')) {
            // $user_id = $this->session->userdata('id');
            $post['uid'] = $this->session->userdata['id'];
            $post['uname'] = $this->session->userdata['Username'];
            if ($insert_id = $this->db->insert('user_log', $post)) {
                return $insert_id;
            } else {
            }
        } else {
        return FALSE;
        }
    }

    /**
     * 修改日志
     * @access public
     * @param  integer $id 日志 id
     * @param  array $post 日志数据
     * @return integer 影响行数
     */
    public function edit($id = 0, $post = array()) {
        if ($affected_rows = $this->m_common->update('log', $post, array('id' => $id))) {
            $this->_delete_cache();
            return $affected_rows;
        } else {
            return FALSE;
        }
    }

    /**
     * 删除日志
     * @access public
     * @param  integer $id 日志 id
     * @return integer 影响行数
     */
    public function del($id = 0) {
        return $this->m_common->delete('log', array('id' => $id));
    }
}