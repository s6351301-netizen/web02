<fieldset>
<legend>會員登入</legend>
<from action="./api/chk_pw.php" method='post'>
<table>
    <tr>
        <td>帳號：</td>
        <td><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
        <td>密碼：</td>
        <td>
        <input type="password" name="pw" id="pw"></td>
        </td>
    </tr>
    <tr>
        <td>
        <input type="submit" value="登入" id="login">
        <input type="reset" value="重置">
        </td>
        <td>
        <a href="?do=reg">尚未註冊</a>
        <a href="?do=forgot">忘記密碼</a>
        </td>
    </tr>
</table>

</from>
</fieldset>