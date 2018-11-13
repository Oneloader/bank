<?php
/**
 * Author: QP
 * Date: 2017-09-09
 */
namespace app\admin\controller;

use think\AjaxPage;
use think\Exception;
use think\Page;
use think\Db;

class Code extends Base
{
    public function index(){
        $count = Db::name('activity')
            ->where(['sid'=>$this->sid,'type'=>1,'status'=>['in',[0,1]]])
            ->count('id');
        if($count){
            $page =  $pager = $page = new Page($count,20);
            //查询活动列表
            $activitys = Db::name('activity')
                ->field('id,name')
                ->where(['sid'=>$this->sid,'type'=>1,'status'=>['in',[0,1]]])
                ->limit($page->firstRow.','.$page->listRows)
                ->order('id desc')
                ->select();
            foreach($activitys as $k=>$v){
                $list = Db::name('codes')->field('use_status')->where(['aid'=>$v['id']])->select();
                $activitys[$k]['total'] = count($list);
                if(!empty($list)){
                    $num = 0;
                    foreach($list as $val){
                        if($val['use_status'] == 1){
                            ++ $num;
                        }
                    }
                    $activitys[$k]['used'] = $num;
                }
            }
        }

        $this->assign([
            'lists' => $activitys,
            'pager' => $pager,
            'count' => $count
        ]);
        return $this->fetch();
    }

    /**
     * 兑换码批次列表
     * @return mixed
     */
    public function code_list()
    {
        $activity_id = input('aid',0);
        if(empty($activity_id)){
            exit('参数丢失');
        }

        $where = ['aid'=>$activity_id,'sid'=>$this->sid];
        $count = Db::name('codes')->where($where)->group('batch')->count('id');
        if($count){
            $pager = $page = new Page($count,20);
            $lists = Db::name('codes')
                ->field('batch,level_id,use_status')
                ->where($where)
                ->limit($page->firstRow.','.$page->listRows)
                ->order(['id'=>'desc'])
                ->group('batch')
                ->select();

            foreach($lists as $k=>$v){
                $where['use_status'] = 1;
                $where['batch'] = $v['batch'];
                $lists[$k]['used'] = Db::name('codes')->where($where)->count('id');

                $where['use_status'] = 0;
                $lists[$k]['not_use'] = Db::name('codes')->where($where)->count('id');
                $lists[$k]['total'] = Db::name('codes')->where(['batch'=>$v['batch']])->count('id');
            }

            $level_ids = array_unique(array_column($lists,'level_id'));
            if(count($level_ids) == 1 && $level_ids[0] == 0){
                $levels = ['无'];
            }else{
                $levels = Db::name('change_level')->where(['id'=>['in',$level_ids]])->getField('id,name');
            }

            $this->assign([
                'lists' => $lists,
                'levels' => $levels,
                'pager' => $pager
            ]);
        }

        $this->assign([
            'count' => $count,
            'aid' => $activity_id,
        ]);
        return $this->fetch();
    }

    /**
     * 兑换码列表
     * @return mixed
     */
    public function codes()
    {
        $activity_id = input('aid',0);
        if(empty($activity_id)){
            exit('参数丢失');
        }

        $batch = input('batch','');
        if(empty($batch)){
            exit('档次编号参数丢失');
        }

        $where = ['aid'=>$activity_id,'batch'=>$batch,'sid'=>$this->sid];
        if($_GET['export'] == 1){
            $type = input('type/d',0);
            $lists = Db::name('codes')->field('code,code_url,level_id,create_time,use_time,use_status')->where($where)->select();
            if(empty($lists)){
                exit('还没有生成兑换码噢');
            }

            if($type == 1){
                //下载兑换二维码
                $photos = array_column($lists,'code_url');
                $name = '兑换二维码' . $batch;
                $this->Tozip($photos,$name.'.zip',2,1);exit();
            }else{
                $level_ids = array_unique(array_column($lists,'level_id'));
                if(count($level_ids) == 1 && $level_ids[0] == 0){
                    $levels = ['无'];
                }else{
                    $levels = Db::name('change_level')->where(['id'=>['in',$level_ids]])->getField('id,name');
                }

                //导出数字码
                $strTable = '<table width="500" border="1">';
                $strTable .= '<tr>';
                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">兑换码编号</td>';
                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">兑换码所属档次</td>';
                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">创建时间</td>';
                $strTable .= '<td style="text-align:center;font-size:12px;" width="*">使用时间</td>';
                $strTable .= '</tr>';
                foreach($lists as $v){
                    $use_time = empty($v['use_status']) ? '未使用' : $v['use_time'];
                    $strTable .= '<tr>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' .$v['code']. '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $levels[$v['level_id']] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $v['create_time'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $use_time . '</td>';
                    $strTable .= '</tr>';
                }
                $strTable .= '</table>';
                downloadExcel($strTable, '兑换数字码');
                unset($lists,$strTable);
                exit();
            }
        }
        $count = Db::name('codes')->where($where)->count('id');
        if($count){
            $pager = $page = new Page($count,20);
            $lists = Db::name('codes')
                ->field('id,code,level_id,code_url,batch,create_time,use_status,use_time')
                ->where($where)
                ->limit($page->firstRow.','.$page->listRows)
                ->order(['id'=>'desc'])
                ->select();

            $level_ids = array_unique(array_column($lists,'level_id'));
            if(count($level_ids) == 1 && $level_ids[0] == 0){
                $levels = ['无'];
            }else{
                $levels = Db::name('change_level')->where(['id'=>['in',$level_ids]])->getField('id,name');
            }

            $this->assign([
                'lists' => $lists,
                'levels' => $levels,
                'pager' => $pager
            ]);
        }

        $this->assign([
            'count' => $count,
            'batch' => $batch,
            'aid' => $activity_id,
        ]);
        return $this->fetch();
    }

    /**
     * 添加兑换码
     * @return mixed
     */
    public function addCodes(){
        //获取活动相关信息
        $activity_id = input('aid',0);
        if(empty($activity_id)){
            exit('参数丢失');
        }

        $activity_info = Db::name('activity')->where(['id'=>$activity_id,'sid'=>$this->sid])->find();
        if(empty($activity_info)){
            exit('查询活动失败');
        }

        if(IS_POST && IS_AJAX){
            $data = input('post.');
            $level_id = empty($data['level_id']) ? 0 : $data['level_id'];

            if($data['num'] <= 0){
                $this->ajaxReturn(['status'=>0,'msg'=>'请输入需要生成的兑换码数量']);
            }
            if($data['num'] > 500){
                $this->ajaxReturn(['status'=>0,'msg'=>'每批次最多生成500个兑换码']);
            }
//            if($data['prefix'] == ""){
//                $this->ajaxReturn(['status'=>0,'msg'=>'请输入兑换码前缀']);
//            }
            if($activity_info['is_level'] == 1 && $level_id <= 0){
                $this->ajaxReturn(['status'=>0,'msg'=>'请选择兑换码所属档次']);
            }

            //商品库存是否充足
            $goods_store = Db::name('activity_goods')->where(['aid'=>$activity_id,'level_id'=>$level_id])->sum('store');
            //未使用的兑换码数
            $not_use_code = Db::name('codes')->where(['aid'=>$activity_id,'level_id'=>$level_id,'use_status'=>0])->count('id');
            if($goods_store - $not_use_code < $data['num']){
                $this->ajaxReturn(['status'=>0,'msg'=>'活动商品剩余库存不足【余：'.$goods_store.'】，请先增加活动商品的库存']);
            }

            //生成兑换码
            $codes = [];
            $code_dir = 'public/upload/ercode/'.$data['batch'];
            if(!file_exists($code_dir)){
                mkdir($code_dir);
            }

            Db::startTrans();
            try{
                for($i=0;$i<$data['num'];$i++){
                    $code = $data['prefix'].strtoupper(get_rand_str(8,0,1));
                    //code是否已经存在？
                    $count = Db::name('codes')->where(['code'=>$code])->count('id');
                    if($count >= 1){
                        $code = $data['prefix'].strtoupper(get_rand_str(8,0,1));
                    }

                    //生成二维码
                    $ercode = $code.'.png';
                    $ercode_path =  ROOT_PATH . $code_dir .'/'. $ercode;
                    if(file_exists($ercode_path)){
                        //文件已存在，重新生成兑换码
                        $code = strtoupper(get_rand_str(8,0,1));
                        //生成二维码
                        $ercode = $code.'.png';
                        $ercode_path =  ROOT_PATH . $code_dir .'/'. $ercode;
                    }

                    //@todo  活动地址
                    $url = SITE_URL . url('Bank/Index/event',['sid'=>base64_encode($this->sid),'aid'=>base64_encode($activity_id),'code'=>$code]);
                    $this->QrCode($url,6,$ercode_path);

                    array_push($codes,[
                        'aid' => $activity_id,
                        'batch' => $data['batch'],
                        'level_id' => empty($data['level_id']) ? 0 : $data['level_id'],
                        'code' => $code,
                        'code_url' => '/'. $code_dir .'/'. $ercode,
                        'use_status' => 0,
                        'create_date' => date('Y-m-d'),
                        'create_time' => date('Y-m-d H:i:s'),
                        'sid' => $this->sid,
                    ]);
                }
                if(!empty($codes)){
                    $r = Db::name('codes')->insertAll($codes);
                }else{
                    $r = false;
                }
                Db::commit();
                if($r){
                    adminLog('生成兑换码成功，批次编号【'.$data['batch'].'】');
                    $this->ajaxReturn(['status'=>1,'msg'=>'生成兑换码成功']);
                }else{
                    $this->ajaxReturn(['status'=>0,'msg'=>'生成兑换码失败']);
                }
            }catch(Exception $e){
                Db::rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'操作失败']);
            }
        }

        if($activity_info['is_level'] == 1){
            $levels = Db::name('change_level')->where(['aid'=>$activity_id,'sid'=>$this->sid])->getField('id,name');
            $this->assign('levels',$levels);
        }

        //批次编号
        $num = Db::name('codes')->where(['aid'=>$activity_id,'sid'=>$this->sid,'create_date'=>date('Y-m-d')])->group('batch')->count('id');
        $num = $num >= 1 ? $num+1 : 1;
        $batch = date('YmdHi').'_'.$activity_id.'_'.$num;
        $this->assign([
            'batch' => $batch,
            'aid' => $activity_id,
            'info' => $activity_info
        ]);
        return $this->fetch();
    }

    /**
     * 作废兑换码
     */
    public function change_status(){
        $id = input('id',0);
        $params = [
            'use_status'=>2,
        ];
        $re = D('codes')->where(['id'=>$id])->save($params);
        if($re){
            successReturn('','操作成功');
        }else{
            errorReturn('操作失败');
        }
    }

    /**
     * 作废全选兑换码
     */
    public function change_all_status(){
        $code_ids = input('post.');
        foreach ($code_ids['code_id'] as $key=>$code_id){
            $code = D('codes')->where(['id'=>$code_id])->find();
            if ($code['use_status']==0){
                $params = [
                    'use_status'=>2,
                ];
                $re = D('codes')->where(['id'=>$code_id])->save($params);
            }
        }
        if($re){
            successReturn('','操作成功');
        }else{
            errorReturn('操作失败');
        }
    }

    /**
     *导入兑换码
     * @return mixed
     */
    public function importCodes(){
        //获取活动相关信息
        $activity_id = input('aid',0);
        if(empty($activity_id)){
            exit('参数丢失');
        }

        $activity_info = Db::name('activity')->where(['id'=>$activity_id,'sid'=>$this->sid])->find();
        if(empty($activity_info)){
            exit('查询活动失败');
        }

        if(IS_POST && IS_AJAX){
            $data = input('post.');
            $level_id = empty($data['level_id']) ? 0 : $data['level_id'];

            if($data['num'] <= 0){
                $this->ajaxReturn(['status'=>0,'msg'=>'请输入需要生成的兑换码数量']);
            }
            if($activity_info['is_level'] == 1 && $level_id <= 0){
                $this->ajaxReturn(['status'=>0,'msg'=>'请选择兑换码所属档次']);
            }

            //商品库存是否充足
            $goods_store = Db::name('activity_goods')->where(['aid'=>$activity_id,'level_id'=>$level_id])->sum('store');
            //未使用的兑换码数
            $not_use_code = Db::name('codes')->where(['aid'=>$activity_id,'level_id'=>$level_id,'use_status'=>0])->count('id');
            if($goods_store - $not_use_code < $data['num']){
                $this->ajaxReturn(['status'=>0,'msg'=>'活动商品剩余库存不足【余：'.$goods_store.'】，请先增加活动商品的库存']);
            }

            //生成兑换码
            $codes = [];
            $code_dir = 'public/upload/ercode/'.$data['batch'];
            if(!file_exists($code_dir)){
                mkdir($code_dir);
            }

            Db::startTrans();
            try{
                for($i=0;$i<$data['num'];$i++){
                    $code = get_rand_str(8,0,1);
                    //code是否已经存在？
                    $count = Db::name('codes')->where(['code'=>$code])->count('id');
                    if($count >= 1){
                        $code = get_rand_str(8,0,1);
                    }

                    //生成二维码
                    $ercode = $code.'.png';
                    $ercode_path =  ROOT_PATH . $code_dir .'/'. $ercode;
                    if(file_exists($ercode_path)){
                        //文件已存在，重新生成兑换码
                        $code = get_rand_str(8,0,1);
                        //生成二维码
                        $ercode = $code.'.png';
                        $ercode_path =  ROOT_PATH . $code_dir .'/'. $ercode;
                    }

                    //@todo  活动地址
                    $url = SITE_URL . url('Bank/Index/event',['sid'=>base64_encode($this->sid),'id'=>base64_encode($activity_id),'code'=>$code]);
                    $this->QrCode($url,6,$ercode_path);

                    array_push($codes,[
                        'aid' => $activity_id,
                        'batch' => $data['batch'],
                        'level_id' => empty($data['level_id']) ? 0 : $data['level_id'],
                        'code' => $code,
                        'code_url' => '/'. $code_dir .'/'. $ercode,
                        'use_status' => 0,
                        'create_date' => date('Y-m-d'),
                        'create_time' => date('Y-m-d H:i:s'),
                        'sid' => $this->sid,
                    ]);
                }
                if(!empty($codes)){
                    $r = Db::name('codes')->insertAll($codes);
                }else{
                    $r = false;
                }
                Db::commit();
                if($r){
                    adminLog('生成兑换码成功，批次编号【'.$data['batch'].'】');
                    $this->ajaxReturn(['status'=>1,'msg'=>'生成兑换码成功']);
                }else{
                    $this->ajaxReturn(['status'=>0,'msg'=>'生成兑换码失败']);
                }
            }catch(Exception $e){
                Db::rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'操作失败']);
            }
        }

        if($activity_info['is_level'] == 1){
            $levels = Db::name('change_level')->where(['aid'=>$activity_id,'sid'=>$this->sid])->getField('id,name');
            $this->assign('levels',$levels);
        }

        //批次编号
        $num = Db::name('codes')->where(['aid'=>$activity_id,'sid'=>$this->sid,'create_date'=>date('Y-m-d')])->group('batch')->count('id');
        $num = $num >= 1 ? $num+1 : 1;
        $batch = date('YmdHi').'_'.$activity_id.'_'.$num;
        $this->assign([
            'batch' => $batch,
            'aid' => $activity_id,
            'info' => $activity_info
        ]);
        return $this->fetch();
    }

    /**
     *
     * 创建二维码
     * @param unknown $data 二维码内容
     * @param number $matrixPointSize 调整大小
     * @param string $ercodePath 要生成路径
     * @param string $qrcolor 颜色
     * @param string $logo 水印logo
     * @internal
     *  $this->QrCode('test',6,ROOT_CMS_PATH.'/data/t.png','#ff22ff');
     */
    public function QrCode($data,$matrixPointSize =6,$ercodePath=False)
    {
        vendor('phpqrcode.phpqrcode');
        $errorCorrectionLevel = "L";
        \QRcode::png ( $data, $ercodePath, $errorCorrectionLevel, $matrixPointSize,2,false);
    }

    /**
     * zip压缩
     * @param $Path
     * @param $ZipFile
     * @param int $Typ
     * @param int $Todo
     * @return bool
     */
    protected function Tozip($Path,$ZipFile,$Typ=1,$Todo=1){
        $Path=Str_iReplace("\\","/",($Path));
        if(Is_Null($Path) Or Empty($Path) Or !IsSet($Path)){Return False;}
        if(Is_Null($ZipFile) Or Empty($ZipFile) Or !IsSet($ZipFile)){Return False;}

        vendor('phpzip');
        $zip = New \PHPZip;
        //if(SubStr($Path,-1,1)=="/"){$Path=SubStr($Path,0,StrLen($Path)-1);}

        OB_end_clean();
        switch ($Typ){
            case "1":
                $zip->ZipDir($Path,$ZipFile,$Todo);
                Break;
            case "2":
                $zip->ZipFile($Path,$ZipFile,$Todo);
                Break;
        }
        if($Todo==1){
            Die();
        }else{
            Return True;
        }
    }
}












