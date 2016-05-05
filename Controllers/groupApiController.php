 <?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-4-15
 * Time: 下午3:33
 */
include $_SERVER['DOCUMENT_ROOT'].'/Controllers/Controller.php';
class groupApiController extends Controller
{

    //扫描二维码加入群组
     public function actionJoinGroupByQrc($groupId){
         $group = $this->M('Group');
         if($group->checkInGroup($groupId,$this->openId)){
             $this->display('Index/msgPage',array(
                 'type'=>'warn',
                 'msg' => '您已经在群组内'
             ));
         }else{
             $group->joinGroup($groupId,$this->openId);
             $user = $this->M('User');
             $user->joinGroup($this->openId,$groupId);
             $this->display('Index/msgPage',array(
                 'type' => 'success',
                 'msg' => '加入群组成功'
             ));
         }
     }

    //创建群组
    public function actionCreateGroup(){
        $groupName = $_POST['groupName'];
        $intro = $_POST['intro'];
        $group = $this->M('Group');
        $groupId = $group->createGroup($this->openId,$groupName,$intro);
        $user = $this->M('User');
        $user->createGroup($this->openId,$groupId);
        $obj = array(
            'groupId' => $groupId,
        );
        $this->logSave('createGroup',$groupId);
        $this->renderAjax($obj);
    }

    //加入群组
    public function actionJoinGroup(){
        $groupId = $_POST['groupId'];
        $name = $_POST['name'];
        $group = $this->M('Group');
        $user = $this->M('User');
        if($group->checkIsCreate($groupId,$this->openId)){
            $this->renderErr("您是群主");
            die;
        }
        if($group->checkInGroup($groupId,$this->openId)){
            $this->renderErr("您已经在群组中.");
            die;
        }
        $group->joinGroup($groupId,$this->openId,$name);
        $user->joinGroup($this->openId,$groupId);
        $this->renderAjax();
    }

    //查找群组
    public function actionFindGroup(){
        $groupId = $_POST['groupId'];
        // $groupId =  "00000001";
        $group = $this->M('Group');
        $groupInfo = $group->findGroupInfo($groupId);
        if($groupInfo == null){
            $this->renderErr("查无此群");
            exit;
        }else{
            $obj = array(
                'groupId' => $groupId,
                'groupName' => $groupInfo['groupName'],
                'createTime' => date('Y-m-d',strtotime($groupInfo['createTime'])),
                'groupNum' => $groupInfo['groupNum'],
                'groupIntro' => $groupInfo['groupIntro']
            );
            $this->renderAjax($obj);
        }
    }

    //修改群组
    public function actionUpdateGroup(){
        $groupId = $_POST['groupId'];
        $groupName = $_POST['groupName'];
        $intro = $_POST['intro'];
        $group = $this->M('Group');
        if($group->checkIsCreate($groupId,$this->openId)){
            $group->updateGroup($groupId,$groupName,$intro);
            $this->logSave('updateGroup',$groupId);
            $this->renderAjax();
        }else{
            $this->renderErr('您没有权限');
        }
    }

    //解散群组
    public function actionDropGroup(){
        $groupId = $_POST['groupId'];
        //验证是否是创建人
        $user = $this->M('User');
        if($user->checkIsCreate($this->openId,$groupId)){
            $res = $user->dropGroup($this->openId,$groupId);
            $group = $this->M('Group');
            $rew = $group->dropGroup($groupId);
            if($res && $rew){
                $this->logSave('dropGroup',$groupId);
                $this->renderAjax();
            }else{
                $this->renderErr('操作失败');
            }
        }else{
            $this->renderErr('您没有权限');
        }
    }

    //退出群组
    public function actionQuitGroup(){
        $groupId = $_POST['groupId'];
        $user = $this->M('User');
        $user->quitGroup($this->openId,$groupId);
        $group = $this->M('Group');
        $group->quitGroup($groupId,$this->openId);
        $this->renderAjax();
    }

    //ajax获取群组成员列表
    public function actionGetMemberList(){
        $groupId = $_POST['groupId'];
        $group = $this->M('Group');
        if($group->checkIsCreate($groupId,$this->openId)){
            $list = $group->getMember($groupId);
            $this->renderAjax($list);
        }else{
            $this->renderErr('您没有权限');
        }
    }

    //ajax修改名字
    public function actionUpdateName(){
        $groupId = $_POST['groupId'];
        $newName = $_POST['newName'];
        $group = $this->M('Group');
        if($group->checkInGroup($groupId,$this->openId)){
            $list = $group->updateName($groupId,$this->openId,$newName);
            $this->renderAjax($list);
        }else{
            $this->renderErr('您没有权限');
        }
    }
}

