<?php if(isset($_SESSION['isLoggedIn'])) :?>
  <div class="jumbotron">
    <h1 class="display-3">History</h1>
  </div>
  <?php echo form_open('history', 'class="history"'); ?>
    <div class="form_history">
      <table>
        <?php
          $json = json_decode($result, TRUE);
        ?>
        <?php if ($json['WorkOrders'] == null): ?>
          <div class="noService">
            <strong>You haven't booked any service so far. <a href="<?php echo base_url(); ?>booking">Book Now!</a></strong>
          </div>
        <?php else: ?>
          <tbody>
            <tr>
              <div class="history_title">
                <th>Scheduled on</th>
                <th>Address</th>
                <th>Subtotal</th>
                <th>Total</th>
                <th>Description</th>
              </div>
            </tr>
            <?php foreach ($json['WorkOrders'] as $jobs): ?>
              <tr>
                <td class="colOne"><?php print_r(date("F j, Y, g:i a", $jobs['dateService'])); ?></td>
                <td class="colTwo"><?php print_r($jobs['Fields'][10]['fieldValue']); ?></td>
                <td class="colThree"><?php echo "$"; print_r($jobs['Fields'][2]['fieldValue']); ?></td>
                <td class="colFour"><?php echo "$"; print_r($jobs['Fields'][5]['fieldValue']); ?></td>
                <td class="colFive"><?php print_r($jobs['Fields'][3]['fieldValue']); ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        <?php endif ?>
      </table>
    </div>
  </form>
<?php else :?>
  <?php show_404() ?>
<?php endif ?>
