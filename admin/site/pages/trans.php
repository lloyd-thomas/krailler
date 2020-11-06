<h1>Translations</h1>

<form method="get" action="/admin/trans/">
  <div class="form-group">
    <label for="langselect">Select Language</label>
  <select id="langselect" name="lang" class="form-control" >
    <option value="1">English</option>
    <option value="23"<?php if (isset($lang) && $lang == 23) echo "selected"; ?>>German</option>
    <option value="94"<?php if (isset($lang) && $lang == 94) echo "selected"; ?>>Russian</option>
    <option value="134"<?php if (isset($lang) && $lang == 134) echo "selected"; ?>>Chinese</option>
    <option value="6"<?php if (isset($lang) && $lang == 6) echo "selected"; ?>>Arabic</option>
  </select>
  <div>
    <input type="submit" class="btn btn-success" value="Select language"/>
</form><br/><br/>
<table  class="table table-striped">
  <thead>
    <tr>
      <th>Text Block</th>
      <th>Translation</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php for ($x=0;$x<sizeof($content);$x++) {
?>
  <tr>
    <form method="post" action="/admin/trans/?lang=<?php echo $lang; ?>">
      <input type="hidden" value="<?php echo $content[$x]['id']; ?>" name="id" />
      <input type="hidden" value="1" name="save" />
    <td><?php echo $content[$x]['content_block']; ?></td>
    <td>
      <div class="form-group">
      <textarea class="form-control" name="content"><?php echo $content[$x]['content']; ?></textarea>
    </div>
    </td>
    <td><input type="submit" class="btn btn-success" value="save"/></td>
  </form>
  </tr>
<?php } ?>
  </tbody>
</table>
