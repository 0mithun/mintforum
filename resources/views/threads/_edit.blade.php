<div class="panel panel-default" v-if="editing">
    <div class="panel-heading">
        <div class="level">
            <h3 class="flex">Edit Thread:  <span  v-text="title"></span> </h3>
        </div>
    </div>

    <div class="panel-body">
        <div class="form-group " >
            <label for="input">Channel:</label>
            <input id="input" class="form-control" type="text" placeholder="Enter channel name" v-model="defaultChannel" >
            <typeahead v-model="typeChannelId" target="#input" :data="channels" item-key="name" force-select/>
         </div>



        <div class="form-group">
            <label for="title" class="control-label">Title:</label>
            <input type="text" id="title" class="form-control" v-model="form.title">
        </div>

        <div class="form-group">
            <label for="tags" class="control-label">
               Tags
            </label>
            <v-select taggable push-tags  v-model="tags" :options="allTags" label="name" multiple></v-select>
        </div>
        <div class="form-group">
            <label for="body" class="control-label">Body:</label>
            <editor
                v-model="form.body"

                api-key="{{  config('services.tiny.key')  }}}"
                :init="{
                selector: '#tinyeditor',
                        plugins: 'code',
                        toolbar: 'formatselect fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | code',
                        menubar: 'tools',
                        toolbar_drawer: 'floating',
                        tinycomments_mode: 'embedded',
                        tinycomments_author: 'Author name'
                }"
            />

{{--            <wysiwyg v-model="form.body"></wysiwyg>--}}
        </div>

        <div class="form-group">
            <label for="location" class="control-label">Location:</label>
            <input type="text" name="location" id="location" class="form-control" v-model="form.location">
        </div>

        <div class="form-group">
            <label for="source" class="control-label">Source:</label>
            <input type="text" name="source" id="source" class="form-control" v-model="form.source">
        </div>

        <div class="form-group">
            <label for="main_subject" class="control-label">Main Subject:</label>
            <input type="text" name="main_subject" id="main_subject" class="form-control" v-model="form.main_subject">
            <span class="help-block">Who is this story about</span>
        </div>

        <div class="form-group">
            <label for="main_subject" class="control-label">Category:</label>
            <div class="checkbox">
                <label><input type="checkbox" value="1" name="is_famous" :checked="checked()" @change="updateChecked()">Famous</label>
                <span class="help-block">Check this box if the subject is Famous</span>
            </div>
        </div>
        <div class="form-group ">
            <label for="main_subject" class="control-label"> Upload an image </label>

            <input type="file" name="image_path" accept="image/*" class="form-control" id="image_path" @change="onFileSelected">

            <div class="checkbox">
                <label><input type="checkbox" value="1" name="allow_image" id="allow_image"
                    @if($thread->allow_image == 1) checked @endif
                    > Allow us to choose a Wikimedia Commons image</label>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <div class="level">
            <button class="btn btn-xs level-item" v-show="! editing">Edit</button>
            <button class="btn btn-primary btn-xs level-item" @click="update" :disabled="checkValidation">Update</button>
            <button class="btn btn-xs level-item" @click="resetForm">Cancel</button>

            @can ('update', $thread)
                <form action="{{ $thread->path() }}" method="POST" class="ml-a">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-link">Delete Thread</button>
                </form>
            @endcan

        </div>
    </div>
</div>