<?php use yii\helpers\Html;?>

<ol class="list-group vertical-steps">
    <li class="list-group-item completed"><span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span></li>
    <li class="list-group-item active"><span>Aliquam tincidunt mauris eu risus.Lorem ipsum dolor sit amet, consectetuer adipiscing elit.Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span</li>
    <li class="list-group-item"><span>Vestibulum auctor dapibus neque.Lorem ipsum dolor sit amet, consectetuer adipiscing elit.Lorem ipsum dolor sit amet, consectetuer adipiscing elit.Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span</li>
</ol>

<div class="stepwizard">
    <div class="stepwizard-row">
        <div class="stepwizard-step">
            <button type="button" class="btn btn-danger btn-circle">1</button>
            <p>Cart</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-primary btn-circle">2</button>
            <p>Shipping</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-success btn-circle" disabled="disabled">3</button>
            <p>Payment</p>
        </div>
    </div>
</div>