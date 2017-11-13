  <h1><b>{{$title}}</b></h1><br/>

<div class="row vertical-scroll">
  
    <table style="border-collapse: collapse;">
    <thead>
        <th style="border:1px solid #000;" >{{getPhrase('name')}}</th>
        <th style="border:1px solid #000;">{{getPhrase('roll_no')}}</th>
        @foreach($final_list['subjects'] as $subs)
        <th style="border:1px solid #000;">{{$subs['subject_code']}}({{$subs['total_marks']}})</th>
        @endforeach
        <th style="border:1px solid #000;">AVG.%</th>
        
        
    </thead>
    <tbody>
  @foreach($final_list['students'] as $student)
    
    <tr>

        <td style="border:1px solid #000;">{{$student['name']}}</td>
        <td style="border:1px solid #000;">{{$student['roll_no']}}</td>

         @foreach($student['marks'] as $mark)
          @if($mark['score'] == null)
          <td style="border:1px solid #000;text-align: center"> - </td>
            @else
               <td style="border:1px solid #000; text-align: right">{{$mark['score']->marks_obtained }}</td>
        @endif
         @endforeach
        <td style="border:1px solid #000; text-align: right">{{$mark['score']->percentage }}</td>
       
        
       
       
       
    </tr> 
    @endforeach
    
    </tbody>
    </table>
</div>