@extends('layouts.backend.app')

@section('title', 'Role page')
@section('content')


    <div class="container">
        <div class="row">
            {{-- Subject --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subject_id">Subject</label>

                    <select id="subject_id" name="subject_id" class="form-control">
                        <option value="">Select Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">
                                {{ $subject->name }}
                            </option>
                        @endforeach

                    </select>
                </div>
            </div>


            {{-- Chapter --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="chapter_id">Chapter</label>

                    <select id="chapter_id" class="form-control">
                        <option value="">Select Chapter</option>
                    </select>
                </div>
            </div>


            {{-- Topic --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="topic_id">Topic</label>

                    <select id="topic_id" class="form-control" >
                        <option value="">Select Topic</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

@endsection()

@push('js')
    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#subject_id").on("change", function() {
                let id = $(this).val();
                $.ajax({
                    url: "{{ url('/topic/chapter') }}/" + id,
                    type: "GET",
                    success: function(res) {
                      console.log(res.data);
                     let chapter = res.data;
                    let html= ``;
                     chapter.forEach((chapter)=>{
                       html+=`<option value="${chapter.id}">${chapter.name}</option>` 
                     });
          
                     $("#chapter_id").html(html);
                    },
                    error: function(err) {
                        console.log(err.responseText);
                    }
                });

            });

            $("#chapter_id").on("change",function(){
               let chapter_id = $(this).val();


               $.ajax({
                  url:"{{url('/topic/topic')}}/" + chapter_id,
                  method:"GET",
                  data:{},
                  success:function(res){
                    let topics= res.data;
                    let html= ``;
                    topics.forEach((topic)=>{
                     html += ` <option value="${topic.id}">${topic.name}</option>` ;
                    });
                    
                    $("#topic_id").append(html);
                   
                  },
                  error:function(error){
                  console.log(error);
                  
                  }
               });
            })

        });
    </script>
@endpush
