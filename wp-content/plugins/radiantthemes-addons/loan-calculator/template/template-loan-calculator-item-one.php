<?php
/**
 * Template Style One Loan Calculator
 *
 * @package Radiantthemes
 */

$output .= '<!-- nav-tabs -->';
$output .= '<ul class="nav-tabs">';
$output .= '<li class="active"><a href="#EMICalculator" data-toggle="tab">' . esc_html__( 'EMI Calculator', 'radiantthemes-addons' ) . '</a></li>';
$output .= '<li><a href="#SavingsCalculator" data-toggle="tab">' . esc_html__( 'Savings Calculator', 'radiantthemes-addons' ) . '</a></li>';
$output .= '</ul>';
$output .= '<!-- nav-tabs -->';
$output .= '<!-- tab-content -->';
$output .= '<div class="tab-content">';
$output .= '<div class="calculator tab-pane fade in active" id="EMICalculator">';
$output .= '<!-- rt-loan-calculator-form -->';
$output .= '<div id="calcCard_1" class="rt-loan-calculator-form">';
$output .= '<!-- form-row -->';
$output .= '<div id="divsliderVLloanAmt_v" class="form-row row">';
$output .= '<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">';
$output .= '<div class="form-row-slider matchHeight">';
$output .= '<div class="sliderBar">';
$output .= '<input id="sliderVLloanAmt_v" class="slider" type="text" data-slider-min="5000" data-slider-max="250000" data-slider-step="100" data-slider-value="5000" data-value="5000" value="5000">';
$output .= '</div>';
$output .= '<span class="pull-left">$5,000</span>';
$output .= '<span class="pull-right">$250,000</span>';
$output .= '<div class="clearfix"></div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">';
$output .= '<div class="form-row-label matchHeight">';
$output .= '<div class="input-group">';
$output .= '<input id="dollarValueVLloanAmt_v" class="form-control dollar" maxlength="10" type="text" value="5000" data-datatype="integer" data-formatter="integer" data-validators="integer;">';
$output .= '<span class="input-group-addon">$</span>';
$output .= '</div>';
$output .= '<label>' . esc_html__( 'Loan Amount', 'radiantthemes-addons' ) . '</label>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<!-- form-row -->';
$output .= '<!-- form-row -->';
$output .= '<div id="divsliderVLloanTerm_v" class="form-row row">';
$output .= '<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">';
$output .= '<div class="form-row-slider matchHeight">';
$output .= '<div class="sliderBar">';
$output .= '<input id="sliderVLloanTerm_v" class="slider" type="text" data-slider-min="12" data-slider-max="84" data-slider-step="12" data-slider-value="12" data-value="12" value="12">';
$output .= '</div>';
$output .= '<span class="pull-left">12</span>';
$output .= '<span class="pull-right">84</span>';
$output .= '<div class="clearfix"></div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">';
$output .= '<div class="form-row-label matchHeight">';
$output .= '<div class="input-group">';
$output .= '<input id="dollarValueVLloanTerm_v" class="form-control loan" type="text" maxlength="2" value="12" data-datatype="integer" data-formatter="integer" data-validators="integer;" pattern="[0-9]*">';
$output .= '<span class="input-group-addon">' . esc_html__( 'mo', 'radiantthemes-addons' ) . '</span>';
$output .= '</div>';
$output .= '<label>' . esc_html__( 'Loan Term', 'radiantthemes-addons' ) . '</label>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<!-- form-row -->';
$output .= '<!-- form-row -->';
$output .= '<div id="divsliderVLloanIr_v" class="form-row row">';
$output .= '<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">';
$output .= '<div class="form-row-slider matchHeight">';
$output .= '<div class="sliderBar">';
$output .= '<input id="sliderVLloanIr_v" class="slider" type="range" data-slider-min="0" data-slider-max="30" data-slider-step="0.01" data-slider-value="0.00" data-value="0" value="0">';
$output .= '</div>';
$output .= '<span class="pull-left">0.00%</span>';
$output .= '<span class="pull-right">30.00%</span>';
$output .= '<div class="clearfix"></div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">';
$output .= '<div class="form-row-label matchHeight">';
$output .= '<div class="input-group">';
$output .= '<input id="dollarValueVLloanIr_v" class="form-control percent" type="text" maxlength="5" value="0" data-datatype="integer" data-formatter="integer" data-validators="integer;">';
$output .= '<span class="input-group-addon">%</span>';
$output .= '</div>';
$output .= '<label>' . esc_html__( 'Interest Rate', 'radiantthemes-addons' ) . '</label>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<!-- form-row -->';
$output .= '<!-- result-row -->';
$output .= '<div class="result-row row">';
$output .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
$output .= '<div class="result-row-label">';
$output .= '<p>' . esc_html__( 'Estimated Monthly Payments ', 'radiantthemes-addons' ) . '</p>';
$output .= '</div>';
$output .= '</div>';
$output .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
$output .= '<div class="result-row-amount">';
$output .= '<p id="vehicleTotal" data-formatter="integer">$416.67</p>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<!-- result-row -->';
$output .= '</div>';
$output .= '<!-- rt-loan-calculator-form -->';
$output .= '</div>';
$output .= '<div class="calculator tab-pane fade" id="SavingsCalculator">';
$output .= '<!-- rt-loan-calculator-form -->';
$output .= '<div id="calcCard_2" class="rt-loan-calculator-form">';
$output .= '<!-- form-row -->';
$output .= '<div id="divsliderVLloanAmt_b" class="form-row row">';
$output .= '<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">';
$output .= '<div class="form-row-slider matchHeight">';
$output .= '<div class="sliderBar">';
$output .= '<input id="sliderVLloanAmt_b" class="slider" type="text" data-slider-min="10000" data-slider-max="250000" data-slider-step="100" data-slider-value="10000" data-value="10000" value="10000">';
$output .= '</div>';
$output .= '<span class="pull-left">$10,000</span>';
$output .= '<span class="pull-right">$250,000</span>';
$output .= '<div class="clearfix"></div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">';
$output .= '<div class="form-row-label matchHeight">';
$output .= '<div class="input-group">';
$output .= '<input id="dollarValueVLloanAmt_b" class="form-control dollar" type="text" maxlength="10" value="10000" data-datatype="integer" data-validators="integer;" data-formatter="integer">';
$output .= '<span class="input-group-addon">$</span>';
$output .= '</div>';
$output .= '<label>' . esc_html__( 'Starting Balance', 'radiantthemes-addons' ) . '</label>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<!-- form-row -->';
$output .= '<!-- form-row -->';
$output .= '<div id="divsliderVLloanTerm_b" class="form-row row">';
$output .= '<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">';
$output .= '<div class="form-row-slider matchHeight">';
$output .= '<div class="sliderBar">';
$output .= '<input id="sliderVLloanTerm_b" class="slider" type="text" data-slider-min="1" data-slider-max="100" data-slider-step="1" data-slider-value="1" data-value="1" value="1">';
$output .= '</div>';
$output .= '<span class="pull-left">1</span>';
$output .= '<span class="pull-right">100</span>';
$output .= '<div class="clearfix"></div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">';
$output .= '<div class="form-row-label matchHeight">';
$output .= '<div class="input-group">';
$output .= '<input id="dollarValueVLloanTerm_b" class="form-control loan" maxlength="2" type="text" value="1" data-datatype="integer" data-validators="integer;" data-formatter="integer" pattern="[0-9]*">';
$output .= '<span class="input-group-addon">' . esc_html__( 'year', 'radiantthemes-addons' ) . '</span>';
$output .= '</div>';
$output .= '<label>' . esc_html__( 'Investment Term', 'radiantthemes-addons' ) . '</label>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<!-- form-row -->';
$output .= '<!-- form-row -->';
$output .= '<div id="divsliderVLloanIr_b" class="form-row row">';
$output .= '<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">';
$output .= '<div class="form-row-slider matchHeight">';
$output .= '<div class="sliderBar">';
$output .= '<input id="sliderVLloanIr_b" class="slider" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="0.01" data-slider-value="8" data-value="8" value="8">';
$output .= '</div>';
$output .= '<span class="pull-left">0.00%</span>';
$output .= '<span class="pull-right">100.00%</span>';
$output .= '<div class="clearfix"></div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">';
$output .= '<div class="form-row-label matchHeight">';
$output .= '<div class="input-group">';
$output .= '<input id="dollarValueVLloanIr_b" class="form-control percent" type="text" value="8" maxlength="5" data-datatype="integer" data-formatter="integer" data-validators="integer;">';
$output .= '<span class="input-group-addon">%</span>';
$output .= '</div>';
$output .= '<label>' . esc_html__( 'Investment Term', 'radiantthemes-addons' ) . '</label>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<!-- form-row -->';
$output .= '<!-- result-row -->';
$output .= '<div class="result-row row">';
$output .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
$output .= '<div class="result-row-label">';
$output .= '<p>' . esc_html__( 'Estimated Monthly Payments ', 'radiantthemes-addons' ) . '</p>';
$output .= '</div>';
$output .= '</div>';
$output .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
$output .= '<div class="result-row-amount">';
$output .= '<p id="boatTotal" data-formatter="integer">$416.67</p>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '<!-- result-row -->';
$output .= '</div>';
$output .= '<!-- rt-loan-calculator-form -->';
$output .= '</div>';
$output .= '</div>';
$output .= '<!-- tab-content -->';
