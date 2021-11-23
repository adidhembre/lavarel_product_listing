<x-header pageTitle="Project Listing Show"/>
    <script>
        function search(){
            try{
                option = {};
                group = document.getElementsByName("group")[0].value;
                if(group != ''){
                    option['group'] = parseInt(group);
                }
                start = document.getElementsByName("start")[0].value;
                if(start != ''){
                    option['start'] = parseInt(start);
                }
                tracked = document.getElementsByName("tracked")[0].value;
                if(tracked != ''){
                    option['tracked'] = parseInt(tracked);
                }
                page = document.getElementsByName("page")[0].value;
                if(page != ''){
                    option['page'] = parseInt(page);
                }
                limit = document.getElementsByName("limit")[0].value;
                if(limit != ''){
                    option['limit'] = parseInt(limit);
                }
                option['_token'] = '{{csrf_token()}}';
                document.getElementsByClassName('app')[0].innerHTML = "<h3 class='centre'>Processing</h3>";
                $.ajax({
                    type:'POST',
                    url:'/ajax',
                    data:option,
                    success:function(data) {
                        $(".app").html(data);
                    },
                }).fail(function() { document.getElementsByClassName('app')[0].innerHTML = "<h3 class='centre'c>Error Occured</h3>";});
            }
            catch{
                alert('Error in Filters Adding!');
            }
        }

        window.onload = function onPageLoad(){
            document.getElementsByClassName('app')[0].innerHTML = "<h3 class='centre'c>Processing</h3>";
            $.ajax({
               type:'POST',
               url:'/ajax',
               data:{_token: '{{csrf_token()}}' },
               success:function(data) {
                  $(".app").html(data);
               },
            }).fail(function() { document.getElementsByClassName('app')[0].innerHTML = "<h3 class='centre'c>Error Occured</h3>";});
        }
    </script>
    <div class='container'>
        <div class='empty'></div>
        <div class="row filters bg-light">
            <div class="col-4">
                <div class='row'>
                    <lable for="group">Group ID</lable>
                    <input type='text' name='group' value='' />
                </div>
            </div>
            <div class="col-4">
                <div class='row'>
                    <lable for="start">Start Year</lable>
                    <input type='text' name='start' value='' />
                </div>
            </div>
            <div class="col-4">
                <div class='row'>
                    <lable for="tracked">Tracked</lable>
                    <input type='text' name='tracked' value='' />
                </div>
            </div>
        </div>
        <div class="row filters bg-light">
            <div class="col-4">
                <div class='row'>
                    <lable for="page">Page</lable>
                    <input type='text' name='page' value='' />
                </div>
            </div>
            <div class="col-4">
                <div class='row'>
                    <lable for="limit">Limit</lable>
                    <input type='text' name='limit' value='' />
                </div>
            </div>
            <div class="col-4">
                <button class='btn btn-primary' onclick="search()">Search</button>
            </div>
        </div>
        <div class='empty'></div>
        <div class="app">
            
        </div>
    </div>
<x-footer/>