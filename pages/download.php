<? if ($_POST['txn_type']=='web_accept'): ?>
<div class="box">
  Thank you for your support, <?= $_POST['first_name'] ?>,<br/>
  your download will start now. If not, click <a href="/downloads/vvvv_js_1_1.zip">here</a>.
</div>
<? else: ?>
<div class="white-popup">
  <h1 style="margin-top:0">Download</h1>
  <p>
    VVVV.js is free to use.
  </p>
  <p>
    If you are making money utilizing VVVV.js, and feel like the project should get its share from it, or just want to show your support, you are
    encouraged to purchase your version of VVVV.js
  </p>
  <p>
    You choose yourself how much you want to pay (and yes, you will get an invoice).
    <b>How much can you spend?</b>
  </p>
  <p>
    <div class="usage_model">
      <input type="radio" name="model" value="paid" checked="checked"/>
      <div class="title">I can spend</div>
      <div id="amount" class="dragdealer">
        <div class="handle">drag me</div>
      </div>
    </div>
    <div class="usage_model inactive">
      <input type="radio" name="model" value="free"/>
      <div class="title">Nothing, maybe some other time.</div>
      <a href="/downloads/vvvv_js_1_1.zip" id="free-download-button" class="button disabled">Free Download</a>
    </div>
  </p>

</div>

<? endif ?>
