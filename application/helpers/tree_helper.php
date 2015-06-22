<?php
function buildTree(array $data,$parent = 0){
    $tree = array();
    foreach ($data as $d) {
        if($d->parent_id == $parent){
            $children = buildTree($data,$d->id);
            if(!empty($children)){
                $d->_children = $children;                  
            }
            $tree[] = $d;
        }
    }
    return $tree;
}
function printTree($tree,$r = 0,$p=null,$id){
    foreach ($tree as $i => $t) {
        $dash =  ($t->parent_id == 0) ? '' : str_repeat('----', $r).' ';        
        $selected = ($t->id == $id) ? 'selected': '';        
        print("\t<option ".$selected." value='".$t->id."'>".$dash.$t->name."</option>\n");
        if($t->parent_id == $p){ //reset $r
            $r = 0;
        }
        if(isset($t->_children)){
            $j = printTree($t->_children,++$r,$t->parent_id,$id);
        }
    }
    return $j;
}
/*function list_menu($parent = 0,$hasil=''){
        $first =  $this->db->query("select * from tr_menu where parent_id ='".$parent."'");
        

        if($first->num_rows() > 0){
            $hasil = "*";
            foreach ($first->result() as $key => $value) {
                $hasil .= "<option value='".$value->id."'>".$value->name."</option>";
                $hasil .= "&nbsp;&nbsp;&nbsp;".$this->list_menu($value->id,$hasil);
                $hasil .= "&";
                
            }
            if($first->num_rows() > 0){
                $hasil .= "";
            }   
            return $hasil;          
        }
    }*/