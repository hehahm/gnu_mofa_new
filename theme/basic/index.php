<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<h2 class="sound_only">최신글</h2>

<!-- 진짜 슬라이드 넣기 -->
<div id="fixedmenu" class="position-fixed">
    <ul id="gnb" class="fix d-flex">
        <li><a href="#">HOME</a></li>
        <li><a href="#">EVENT</a></li>
        <li><a href="#">PROGRAM</a></li>
        <li><a href="#">VIDEO</a></li>
        <li><a href="#">PARTICIPANTS</a></li>
        <li><a href="#">CUSTOM TEST</a></li>
        <li><a href="#">ROSTER</a></li>
    </ul>
</div>
<div class="container_w" >

<?php echo latest('theme/first','banner',1,100);?>
  
      

        <div class="container_2">
        <?php echo latest('theme/poster','poster',1,100);?>

        </div>
        <div class="container_3">
        <?php echo latest('theme/basic','event',1,100);?>
        </div>
        
        <div class="container_4">
        <?php echo latest('theme/basic','program',1,100);?>
        </div>

        <div class="container_4">
        <?php echo latest('theme/basic','brochure',1,100);?>
        </div>

        <div class="container_4">
        <?php echo latest('theme/basic','org',1,100);?>
        </div>

        <div class="container_4">
        <?php echo latest('theme/basic','testForm',1,100);?>
        </div>

        <div class="container_4">
        <?php echo latest('theme/basic','testResult',1,100);?>
        </div>

        <div class="container_4">
        <?php echo latest('theme/basic','roster',1,100);?>
        </div>
    </div>
    <!-- 최신글 끝 -->

<div class="latest_top_wr">
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    echo latest('theme/pic_list', 'free', 4, 23);		// 최소설치시 자동생성되는 자유게시판
	echo latest('theme/pic_list', 'qa', 4, 23);			// 최소설치시 자동생성되는 질문답변게시판
	echo latest('theme/pic_list', 'notice', 4, 23);		// 최소설치시 자동생성되는 공지사항게시판
    ?>
</div>
<div class="latest_wr">
    <!-- 사진 최신글2 { -->
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    echo latest('theme/pic_block', 'gallery', 4, 23);		// 최소설치시 자동생성되는 갤러리게시판
    ?>
    <!-- } 사진 최신글2 끝 -->
</div>

<div class="latest_wr">
<!-- 최신글 시작 { -->
    <?php
    //  최신글
    $sql = " select bo_table
                from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
                where a.bo_device <> 'mobile' ";
    if(!$is_admin)
	$sql .= " and a.bo_use_cert = '' ";
    $sql .= " and a.bo_table not in ('notice', 'gallery') ";     //공지사항과 갤러리 게시판은 제외
    $sql .= " order by b.gr_order, a.bo_order ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		$lt_style = '';
    	if ($i%3 !== 0 ) $lt_style = "margin-left:2%";
    ?>
    <div style="float:left;<?php echo $lt_style ?>" class="lt_wr">
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/basic', $row['bo_table'], 6, 24);
        ?>
    </div>
    <?php
    }
    ?>
    <!-- } 최신글 끝 -->
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');