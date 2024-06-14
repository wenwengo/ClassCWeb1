
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">網站標題管理</p>
    <form method="post" action="./api/edit_title.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="45%">網站標題</td>
                    <td width="23%">替代文字</td>
                    <td width="7%">顯示</td>
                    <td width="7%">刪除</td>
                    <td></td>
                </tr>
                <?php
                // include_once "../api/base.php"; //本列替代以下兩列
                // $dsn = "mysql:host=localhost;charset=utf8;dbname=db991";
                // $pdo = new PDO($dsn, 'root', '');

                $row=$Title->all();
                // $sql = "select * from title";
                // $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row) {

                ?>
                    <tr class='cent'>
                        <td width="45%">
                            <img src="./images/<?= $row['img']; ?>" style='width:300px;height:30px'>
                        </td>
                        <td width="23%">
                            <input type="text" name="text[]" id="text" value="<?= $row['text']; ?>">
                        </td>
                        <td width="7%">
                            <input type="radio" name="sh" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? "checked" : ""; ?>>
                        </td>
                        <td width=" 7%">
                            <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
                        </td>
                        <td></td>
                        <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <table style=" margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px">
                        <input type="button" onclick="op('#cover','#cvr','./modals/title.php')" value="新增網站標題圖片">
                    </td>
                    <td class="cent">
                        <input type="hidden" name="table" value="<?=$dp; ?>">
                        <input type="submit" value="修改確定">
                        <input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</div>