<?php

use yii\helpers\Url;

/**'
 * @var \app\modules\quick\models\Questions $q
 * @var \app\modules\quick\models\Questions $s
 * @var \app\modules\quick\models\Questions $l
 * @var \app\modules\quick\models\Questions $r
 * @var \app\modules\quick\models\Questions $a
 *
 */
use app\assets\RemodalAsset;
use app\modules\quick\models\Categories;
use app\models\User;
use app\modules\quick\models\Answers;
use app\modules\game\models\Game;

RemodalAsset::register($this);

$this->title = Yii::t('app', 'Quick Game');

?>
<?php
if($r){
    $ranks = $r->ranks;
echo "
<div class=\"progress\">
    <div class=\"progress-bar progress-bar-striped active\" role=\"progressbar\" aria-valuenow=\"$ranks\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:$ranks%;\">
        <span class=\"sr-only\">$ranks% Complete</span>
    </div>
</div>
";
}
?>
<br>

<div style="text-align: center; font-size: 18px; font-family: 'Indie+Flower';">
    <br>
    <img src="<?= $q->images[0]->url ?>" style="max-width: 300px; display: inline-block; border-radius: 50%;">
    <br>
    <br>

    <?= $q->text ?>

    <br>
    <br>

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <?php
         ?>
        <div class="btn-group" role="group">
            <?php foreach ($q->answers as $answer) : ?>
                <a type="button" class="btn btn-default green"
                    <?php
//                    $correct = $answer->correct_answer_id;
//                    if(empty($correct)){}
                    ?>
                   href="<?= Url::to(['/game/game/answers', 'question_id' => $q->id, 'answer_id' => $answer->id]);?>"><?= $answer->text ?></a>
                <br><br>

            <?php endforeach; ?>
        </div>

    </div>
    <br>
    <br>
</div>

<div class="remodal" data-remodal-id="attention" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
    <div>
        <h2 id="modal1Title">Another Attempt</h2>
        <p id="modal1Desc">
            <img id="pinokio" src="/images/pinokio/pingame/attempt1/pingi.gif" alt="you lose">
        </p>
    </div>
    <br>
    <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
</div>

<div class="remodal" data-remodal-id="over" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">

    <div>
        <h2 id="modal1Title">Game Over</h2>
        <p id="modal1Desc">
            <img id="pinokio" src="/images/pinokio/pingame/attempt2/pingi2.gif" alt="game over">
        </p>
    </div>
    <br>
    <a type='button' href="/" class="remodal-cancel">Main Page</a>
    <a type='button' href="index" class="remodal-confirm">New Game</a><!--data-remodal-action="confirm"-->
</div>

<?php
if($l==2)
{
    echo '
    <script type="text/JavaScript">
    function doRedirect() {
        atTime = "500";
        toUrl = "start#attention";

        setTimeout("location.href = toUrl;", atTime);
    }
</script>

<body onload="doRedirect();">';
}
if($l==1)
{
    echo '
    <script type="text/JavaScript">
    function doRedirect() {
        atTime = "500";
        toUrl = "start#over";

        setTimeout("location.href = toUrl;", atTime);
    }
</script>

<body onload="doRedirect();">';
}?>



