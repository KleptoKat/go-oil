<?php echo form_open('secureQuestion'); ?>
  <div class="jumbotron">
    <h1 class="display-3">Question</h1>
  </div>
  <div class="form_secure_question">
    <?php if (isset($errorMessage)) :?>
      <div class="errorMessage">
        <p><?=$errorMessage ?></p>
      </div>
    <?php endif ?>
    <div class="form-group">
      <label for="securityAnswer"><?php echo $secureQuestion; ?></label>
      <input name="securityAnswer" type="securityAnswer" class="form-control" id="questionAnswer" aria-describedby="securityAnswerHelp">
    </div>
    <div class="button-group">
      <input type="submit" class="btn btn-primary" id="questionSubmit" value="Submit"/>
    </div>
  </div>
</form>
