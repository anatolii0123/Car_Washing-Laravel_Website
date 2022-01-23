<form method="post" id="location_general_form">
    @csrf
    <input type="hidden" name="id" id="id" value={{ $location->id }}>
    <div class="form-group">
        <label for="defaultInput">Name</label>
        <input class="form-control" type="text" placeholder="Location Name" name="name"  id="name" value="{{ $location->name }}"/>
    </div>
    <div class="form-group">
        <label for="defaultInput">Address</label>
        <div class="row">
            <div class="col-4">
                <input class="form-control" type="text" placeholder="Address" name="address"  id="address" value="{{ $location->address }}"/>
            </div>
            <div class="col-4">
                <input class="form-control" type="text" placeholder="Street" name="street"  id="street" value="{{ $location->street }}"/>
            </div>
            <div class="col-4">
                <input class="form-control" type="text" placeholder="City" name="city"  id="city" value="{{ $location->city }}"/>
            </div>
        </div>
    </div>
    {{-- <div class="form-group">
        <label for="defaultInput">Description</label>
        <div id="description_wrapper">
            <div id="description_container">
                <div class="quill-toolbar">
                    <span class="ql-formats">
                        <select class="ql-header">
                            <option value="1">Heading</option>
                            <option value="2">Subheading</option>
                            <option selected>Normal</option>
                        </select>
                        <select class="ql-font">
                            <option selected>Sailec Light</option>
                            <option value="sofia">Sofia Pro</option>
                            <option value="slabo">Slabo 27px</option>
                            <option value="roboto">Roboto Slab</option>
                            <option value="inconsolata">Inconsolata</option>
                            <option value="ubuntu">Ubuntu Mono</option>
                        </select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-link"></button>
                        <button class="ql-image"></button>
                        <button class="ql-video"></button>
                    </span>
                </div>
                <div class="editor">
                    {{ $location->description }}
                </div>
            </div>
        </div>
    </div> --}}
    <div class="form-group">
        <label for="defaultInput">Start - End</label>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="first-name">Monday</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Mon_start" id="Mon_start" placeholder="Start time"  value="{{ $location->Mon_start }}"/>
                    </div>
                    <div class="col-sm-1" style="align-items: center; display: flex;">
                        <i data-feather='minus'></i>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Mon_end" id="Mon_end" placeholder="End time"  value="{{ $location->Mon_end }}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="first-name">Wensday</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Wed_start" id="Wed_start" placeholder="Start time"  value="{{ $location->Wed_start }}"/>
                    </div>
                    <div class="col-sm-1" style="align-items: center; display: flex;">
                        <i data-feather='minus'></i>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Wed_end" id="Wed_end" placeholder="End time"  value="{{ $location->Wed_end }}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="first-name">Tuesday</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Tue_start" id="Tue_start" placeholder="Start time"  value="{{ $location->Tue_start }}"/>
                    </div>
                    <div class="col-sm-1" style="align-items: center; display: flex;">
                        <i data-feather='minus'></i>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Tue_end" id="Tue_end" placeholder="End time"  value="{{ $location->Tue_end }}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="first-name">Thursday</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Thu_start" id="Thu_start" placeholder="Start time"  value="{{ $location->Thu_start }}"/>
                    </div>
                    <div class="col-sm-1" style="align-items: center; display: flex;">
                        <i data-feather='minus'></i>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Thu_end" id="Thu_end" placeholder="End time"  value="{{ $location->Thu_end }}"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="first-name">Friday</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Fri_start" id="Fri_start" placeholder="Start time"  value="{{ $location->Fri_start }}"/>
                    </div>
                    <div class="col-sm-1" style="align-items: center; display: flex;">
                        <i data-feather='minus'></i>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Fri_end" id="Fri_end" placeholder="End time"  value="{{ $location->Fri_end }}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="first-name">Saturday</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Sat_start" id="Sat_start" placeholder="Start time"  value="{{ $location->Sat_start }}"/>
                    </div>
                    <div class="col-sm-1" style="align-items: center; display: flex;">
                        <i data-feather='minus'></i>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Sat_end" id="Sat_end" placeholder="End time"  value="{{ $location->Sat_end }}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="first-name">Sunday</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Sun_start" id="Sun_start" placeholder="Start time"  value="{{ $location->Sun_start }}"/>
                    </div>
                    <div class="col-sm-1" style="align-items: center; display: flex;">
                        <i data-feather='minus'></i>
                    </div>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="Sun_end" id="Sun_end" placeholder="End time"  value="{{ $location->Sun_end }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="defaultInput">Interval</label>
        <input class="form-control" type="text" placeholder="Interval" name="interval"  id="interval"  value="{{ $location->interval }}"/>
    </div>
    <button type="button" class="btn btn-primary mr-1" id="submit">Submit</button>
</form>