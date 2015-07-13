@extends('layout/backend')
@section('content')
    <div class="edit-header" style="background-color:#f1f4f9;padding:2px;border-bottom:1px solid #dee2e8;">
        <p>Backend / <span style="color:#0AA699;">Downloads</span> / @if(isset($entry)) Edit @else Add @endif</p>
    </div>
    <div class="edit-header" style="background-color:#e9edf2;border-bottom:1px solid #dee2e8;">
        <div style="float:left;margin-left:25px;margin-top:15px;"><img src="{{URL('/images/backend/addContent.png')}}"></div><h1 style="float:left;margin-left:10px;">@if(isset($entry)) Edit @else Add @endif download</h1>
        <div style="clear:both;"></div>
    </div>
    <div class="pad">
        @if (Session::has('error'))
            <p class="error">{{Session::get('error')}}</p>
        @elseif (Session::has('success'))
            <p class="success">{{Session::get('success')}}</p>
        @endif
        <form method="post" role="post" action="@if(isset($entry)){{route('update_download')}}@else{{route('insert_download')}}@endif">
            <div class="two" style="padding-right:5px;">
                <!-- Downloads name -->
                <div class="three"><label class="basic-label" style="margin-bottom:8.5px;">Name</label></div>
                <div class="three-two">
                    <input name="name" placeholder="Name" type="text" value="@if(isset($entry)){{$entry['name']}}@endif" REQUIRED />
                </div>
                <div style="clear:both;"></div>
                <!-- Downloads title -->
                <div class="three"><label class="basic-label" style="margin-bottom:8.5px;">Title</label></div>
                <div class="three-two">
                    <input name="title" placeholder="Title" type="text" value="@if(isset($entry)){{$entry['title']}}@endif" REQUIRED />
                </div>
                <div style="clear:both;"></div>
                <!-- Downloads category -->
                <div class="three"><label class="basic-label" style="margin-bottom:8.5px;">Category</label></div>
                <div class="three-two">
                    <select name="category" style="width:100%;">
                        <option value="1" @if(isset($entry))@if($entry['category'] == 1)selected @endif @endif>Steerable</option>
                        <option value="2" @if(isset($entry))@if($entry['category'] == 2)selected @endif @endif>Tools</option>
                        <option value="3" @if(isset($entry))@if($entry['category'] == 3)selected @endif @endif>Trailers</option>
                        <option value="4" @if(isset($entry))@if($entry['category'] == 4)selected @endif @endif>Maps</option>
                        <option value="5" @if(isset($entry))@if($entry['category'] == 5)selected @endif @endif>Objects</option>
                        <option value="6" @if(isset($entry))@if($entry['category'] == 6)selected @endif @endif>Scripts</option>
                        <option value="7" @if(isset($entry))@if($entry['category'] == 7)selected @endif @endif>Others</option>
                    </select>
                </div>
                <div style="clear:both;"></div>
                <!-- Downloads state -->
                <div class="three"><label class="basic-label" style="margin-bottom:8.5px;">State</label></div>
                <div class="three-two">
                    <select name="state" style="width:100%;">
                        <option value="1" @if(isset($entry))@if($entry['state'] == 1)selected @endif @endif>Public</option>
                        <option value="2" @if(isset($entry))@if($entry['state'] == 2)selected @endif @endif>Private</option>
                    </select>
                </div>
                <div style="clear:both;"></div>
                <!-- Downloads download link -->
                <div class="three"><label class="basic-label" style="margin-bottom:8.5px;">Download link</label></div>
                <div class="three-two">
                    <select name="download" style="width:100%;">
                        <?php
                        foreach($files as $file){
                            $ex = $file->getExtension();
                            if(!$file->isDot() && $ex=='zip' || $ex=='rar' || $ex=='exe'){
                                echo '<option>'.$file.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div style="clear:both;"></div>
                <!-- Downloads description -->
                <div class="three" style="width:calc(100% - 15px);"><label class="basic-label" style="margin-bottom:8.5px;">Description</label></div>
                <div class="three-two" style="width:100%;margin-bottom:8.5px;">
                    <textarea name="desc">@if(isset($entry)){{$entry['desc']}}@endif</textarea>
                </div>
                <div style="clear:both;"></div>
                <!-- Downloads change log -->
                <div class="three" style="width:calc(100% - 15px);"><label class="basic-label" style="margin-bottom:8.5px;">Change log</label></div>
                <div class="three-two" style="width:100%;margin-bottom:8.5px;">
                    <textarea name="log">@if(isset($entry)){{$entry['log']}}@endif</textarea>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="two" style="padding-right:5px;">
                <!-- Downloads information -->
                <div class="three" style="width:calc(100% - 15px);"><label class="basic-label" style="margin-bottom:8.5px;">Information</label></div>
                <div class="three-two" style="width:100%;margin-bottom:8.5px;">
                    <textarea class="list" name="info">@if(isset($entry)){{$entry['info']}}@endif</textarea>
                </div>
                <div style="clear:both;"></div>
                <!-- Downloads features -->
                <div class="three" style="width:calc(100% - 15px);"><label class="basic-label" style="margin-bottom:8.5px;">Features</label></div>
                <div class="three-two" style="width:100%;margin-bottom:8.5px;">
                    <textarea class="list" name="features">@if(isset($entry)){{$entry['features']}}@endif</textarea>
                </div>
                <div style="clear:both;"></div>
                <!-- Downloads credits -->
                <div class="three" style="width:calc(100% - 15px);"><label class="basic-label" style="margin-bottom:8.5px;">Credits</label></div>
                <div class="three-two" style="width:100%;margin-bottom:8.5px;">
                    <textarea class="list" name="credits">@if(isset($entry)){{$entry['credits']}}@endif</textarea>
                </div>
                <div style="clear:both;"></div>
                <!-- Downloads images -->
                <div class="three" style="width:calc(100% - 15px);"><label class="basic-label" style="margin-bottom:8.5px;">Images</label></div>
                <div class="three-two" style="width:100%;margin-bottom:8.5px;">
                    <div class="images">
                        @if(isset($entry))
                            <?php $images = array_filter(explode(';', $entry['images'])); ?>
                            @foreach($images as $image)
                                <div style="margin:2px;width:calc(33.3333333333% - 4px);float:left;">
                                    <a href="{{URL('/media/' . $image)}}">
                                        <img style="width:100%;width:100%;" src="{{URL('/media/' . $image)}}" />
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <img id="imageview" style="width:100%;width:100%;" src="" />
                    <div style="clear:both;margin-bottom:7px;"></div>
                    <select id="imageselect" name="image" style="width:85%;float:left;" onchange="changeImage(this.value);">
                        <?php
                        foreach($files as $file){
                            $ex = $file->getExtension();
                            if(!$file->isDot() && $ex=='png' || $ex=='jpg' || $ex=='gif'){
                                echo '<option>'.$file.'</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="button" name="Add" value="Add" class="btn blue" style="width:calc(15% - 10px);float:left;" onclick="getPath()">
                    <input id="pathString" type="hidden" name="pathString" value="<?php if(isset($entry)){echo $entry['images'];} else{echo '';} ?>;" />
                </div>
                <div style="clear:both;"></div>
            </div>
            <div style="clear:both;"></div>


            @if(isset($entry))
                <input type="hidden" name="id" value="{{$entry->id}}">
            @endif
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <hr/>
            <div style="background-color: #f1f1f1;padding:2px;height:55px;width:100%;">
                <div style="margin:0 auto;width:200px;">
                    <input type="submit" name="Save" value="Save" class="btn blue">
                    <input type="button" name="Cancel" value="Cancel" class="btn red" onclick="">
                </div>
            </div>
            <div style="background-color:#ccc;height:5px;"></div>
        </form>
    </div>
    <script>
        var pathString = "<?php if(isset($entry)){echo $entry['images'];} else{echo '';} ?>";

        function getPath() {
            var item = $("#imageselect").val();
            var itemPath = '{{URL('/media')}}' + '/' + item;
            $(".images").prepend(function() {
                return "<div style='margin:2px;width:calc(33.3333333333% - 4px);float:left;'><a href='" + itemPath + "'><img style='width:100%;width:100%;' src='" + itemPath + "'></a></div>";
            });
            pathString += item + ';';
            console.log(pathString);
            $( "#pathString" ).val( pathString );
        }
        tinymce.init({
            selector: "textarea.list",
            theme: "modern",
            resize: false,
            convert_urls: false,
            statusbar : false,
            menubar : false,
            height: 100,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar1: "bullist",
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ]
        });
        tinymce.init({
            selector: "textarea",
            theme: "modern",
            resize: false,
            convert_urls: false,
            statusbar : false,
            menubar : false,
            height: 175,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons",
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ]
        });
    </script>
@endsection