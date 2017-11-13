
<h1><b>{{$title}}</b></h1><br/>
<div class="row vertical-scroll">
  
    <table style="border-collapse: collapse;">
<?php $currency  = getCurrencyCode();?>
    <thead>
        <th style="border:1px solid #000;">{{getPhrase('sno')}}</th>
        <th style="border:1px solid #000;" >{{getPhrase('name')}}</th>
        <th style="border:1px solid #000;">{{getPhrase('roll_no')}}</th>
        <th style="border:1px solid #000;">{{getPhrase('amount')}}</th>
        <th style="border:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp;{{getPhrase('paid_amount')}}&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th style="border:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp;{{getPhrase('discount')}}&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th style="border:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp;{{getPhrase('balance')}}&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th style="border:1px solid #000;">%</th>
        @for($i=1; $i<=$extracols;$i++)
        <th style="border:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        @endfor
       
        
    </thead>
    <tbody>
    <?php $sno =1;?>
     @foreach($records as $record)
    <tr>
        
        <td style="border:1px solid #000; text-align: right;">{{$sno++}}</td>
        <td style="border:1px solid #000;">{{$record['name']}}</td>
        <td style="border:1px solid #000;">{{$record['roll_no']}}</td>
        <td style="border:1px solid #000;text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$currency}} {{$record['amount']}}</td>
        <td style="border:1px solid #000;text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$currency}} {{$record['paid_amount']}}</td>
        <td style="border:1px solid #000;text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$currency}} {{$record['discount_amount']}}</td>
        <td style="border:1px solid #000;text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$currency}} {{$record['balance']}}</td>
        <td style="border:1px solid #000;text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$record['paid_percentage']}}</td>
         @for($i=1; $i<=$extracols;$i++)
        <th style="border:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        @endfor
        
       
    </tr> 
    @endforeach
    </tbody>
    </table>
</div>