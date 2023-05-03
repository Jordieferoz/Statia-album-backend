<section class="hk-sec-wrapper">
<h5 class="hk-sec-title">LOGIN HISTORY</h5>
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <table id="datable_1" class="table table-hover w-200">
                <thead>
                    <tr>
                        <th>Date - Time</th>
                        <th>OS</th>
                        <th>Browser</th>
                        <th>Remote address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($LOGIN_HISTORY as $history) {
                            ?>
                                <tr>
                                    <td><?php echo $history->login_date . ' - ' . $history->login_time; ?></td>
                                    <td><?php echo $history->os; ?></td>
                                    <td><?php echo $history->browser; ?></td>
                                    <td><?php echo $history->ip; ?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>