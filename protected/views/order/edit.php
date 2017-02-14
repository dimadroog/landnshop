<h2>Редактировать заказ <?php echo $item->id.'-'.$item->customer->id.'-'.date('dmy' , $item->date) ?></h2>
<form action="" onsubmit="return CheckRequired()" method="post" enctype="multipart/form-data">
    <div class="ajax-hidden">


        <div class="row">
            <div class="col-sm-6">
            
                <div class="form-group">
                    <label class="control-label" for="status">Состояние заказа <span class="text-danger">*</span></label>
                    <select id="status" class="form-control required" name="status">
                        <?php if ($item->status == "1"): ?>
                            <option default value="1">Выполнен</option>
                            <option value="0">Ожидает выполнения</option>
                        <?php else: ?>
                            <option default value="0">Ожидает выполнения</option>
                            <option value="1">Выполнен</option>
                        <?php endif ?>
                    </select>
                </div>
            
                <div class="form-group">
                    <label class="control-label" for="customer">Клиент <span class="text-danger">*</span></label>
                    <select id="customer" class="form-control required" name="customer">
                        <option default value="<?php echo $item->customer->id; ?>"><?php echo $item->customer->id.'; '.$item->customer->name.'; '.$item->customer->mail; ?></option>
                        <?php foreach ($users as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->id.'; '.$value->name.'; '.$value->mail; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
  
            </div>
        </div>

        <div class="row">
            <div class='col-sm-6'>
                <div class="form-group">
                <label class="control-label" for="date">Дата <span class="text-danger">*</span></label>
                    <div class='input-group date' id='datetimepicker'>
                        <input type='text' class="form-control required" name="date">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function() {
              jQuery('#datetimepicker').datetimepicker({
                  locale: 'ru',
                  format: 'DD.MM.YYYY',
                  defaultDate: new Date(<?php echo $item->date; ?> * 1000),
                  // defaultDate: Date.now(),
              });
            });
            
        </script>


            <input type="hidden" class="form-control" name="json" id="json" value='<?php echo $item->json; ?>'>
            <input type="hidden" class="form-control" name="sum" id="sum" value='<?php echo $item->sum; ?>'>

        <label>Содержимое заказа</label>
        <div class="table-responsive">
            <table class="table table-hover table-bordered"> 
                <thead> 
                    <tr class="bg-primary"> 
                        <th>id</th> 
                        <th>Название</th> 
                        <th>Ед. изм.</th>
                        <th>Цена</th> 
                        <th>Количество</th>
                        <th>Сумма</th>
                        <th>Действие</th>
                    </tr> 
                </thead> 
                <tbody>
                    <?php foreach (json_decode($item->json, true) as $value):?> 
                        <tr class="rows-edit"> 
                            <td>
                                <span class="id-edit"><?php echo $value['id']; ?></span>
                            </td>
                            <td>
                                <span class="title-edit"><?php echo $value['title']; ?></span>
                            </td>
                            <td>
                                <span class="unit-edit"><?php echo $value['unit']; ?></span>

                            </td>
                            <td>    
                                <span class="price-edit"><?php echo $value['price']; ?></span>
                            </td>
                            <td>
                                <span class="amount-edit"><?php echo $value['count']; ?></span>
                                <a onclick="countUp(this, <?php echo Article::getData($value['id'], 'amount'); ?>)"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a>
                                <a onclick="countDown(this, <?php echo Article::getData($value['id'], 'min_amount'); ?>)"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
                            </td>
                            <td>
                                <span class="sum-edit"><?php echo $value['sum']; ?></span>        
                            </td>
                            <td>
                                <a onclick="delRow(this)">Удалить</a>        
                            </td>
                        </tr> 
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-sm-6">
            <select id="prodselect" onchange="addToOrder(this)">
                <option disabled="true" selected="selected">Добавть товары в заказ</option>
            <?php foreach ($products as $value): ?>
                <option
                    data-price="<?php echo $value->price; ?>" 
                    data-unit="<?php echo $value->unit; ?>" 
                    data-min_amount="<?php echo $value->min_amount; ?>"
                    data-amount="<?php echo $value->amount; ?>" 
                    value="<?php echo $value->id; ?>"
                    ><?php echo $value->title; ?></option>
            <?php endforeach ?>
            </select>
            </div>
            <div class="col-sm-6 right-to-left">
                <p>Итоговая сумма: <b><span id="total_sum"><?php echo $item->sum; ?></span></b></p>
            </div>
        </div>  

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>


<script type="text/javascript">
    function addToOrder(elm){

        var selected_option = jQuery(elm).find(':selected');
        var id = selected_option.val();
        var ids_in_table = [];
        jQuery('.id-edit').each(function(){
            ids_in_table.push(jQuery(this).text());
        })

        for (var i in ids_in_table) {
            if (ids_in_table[i] == id) {
                alert('Этот товар уже есть в заказе');
                jQuery('#prodselect').prop('selectedIndex',0);
                return false;
            }
        }
        var title = selected_option.html();
        var price = selected_option.data('price');
        var amount = selected_option.data('amount');
        var min_amount = selected_option.data('min_amount');
        var unit = selected_option.data('unit');
        var td_id = '<td><span class="id-edit">'+id+'</span></td>';
        var td_title = '<td><span class="title-edit">'+title+'</span></td>';
        var td_unit = '<td><span class="unit-edit">'+unit+'</span></td>';
        var td_price = '<td><span class="price-edit">'+price+'</span></td>';
        var td_amount = '<td><span class="amount-edit">'+min_amount+'</span> <a onclick="countUp(this, '+amount+')"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a> <a onclick="countDown(this, '+min_amount+')"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a></td>';
        var td_sum = '<td><span class="sum-edit">'+parseInt(min_amount)*parseInt(price)+'</span></td>';
        var td_action = '<td><a onclick="delRow(this)">Удалить</a></td>';
        jQuery('tbody').append('<tr class="rows-edit">'+td_id+td_title+td_unit+td_price+td_amount+td_sum+td_action+'</tr>');
        jQuery('#prodselect').prop('selectedIndex',0);
        jsonRefresh();

    }

    function countUp(elm, max){
        var amount = jQuery(elm).parent().find('.amount-edit');
        var sum = jQuery(elm).parent().parent().find('.sum-edit');
        var price = jQuery(elm).parent().parent().find('.price-edit');
        if (parseInt(amount.text()) < parseInt(max)) {
            amount.text(parseInt(amount.text())+1);
            sum.text(parseInt(amount.text())*parseInt(price.text()));
            jsonRefresh();
        } else {
            alert('Недостаточно товара в наличии');
        }
    }
    function countDown(elm, min){
        var amount = jQuery(elm).parent().find('.amount-edit');
        var sum = jQuery(elm).parent().parent().find('.sum-edit');
        var price = jQuery(elm).parent().parent().find('.price-edit');
        if (parseInt(amount.text()) > parseInt(min)) {
            amount.text(parseInt(amount.text())-1);
            sum.text(parseInt(amount.text())*parseInt(price.text()));
            jsonRefresh();
        } else {
            alert('Недостаточно для минимального заказа');
        }
    }
    function jsonRefresh(){
        var list = [];
        var total = 0;
        jQuery('.rows-edit').each(function(){
            var id = jQuery(this).find('.id-edit').text();
            var title = jQuery(this).find('.title-edit').text();
            var price = jQuery(this).find('.price-edit').text();
            var count = jQuery(this).find('.amount-edit').text();
            var sum = jQuery(this).find('.sum-edit').text();
            var unit = jQuery(this).find('.unit-edit').text();
            list.push({"id":id, "title":title, "price":price, "count":count, "sum":sum, "unit":unit});
            total+=parseInt(jQuery(this).find('.sum-edit').text());
        });
        var json = JSON.stringify(list);
        jQuery('#json').val(json);
        jQuery('#sum').val(total);
        jQuery('#total_sum').text(total);
    }

    function delRow(elm){
        jQuery(elm).closest('.rows-edit').remove();
        jsonRefresh();
    }
</script>