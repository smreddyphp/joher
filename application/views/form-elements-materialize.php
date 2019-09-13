  <?php include('header.php'); ?>
     <?php include('aside.php'); ?>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">

            <!-- Header start -->
            <div class="row">
                <div class="main-header">
                    <h4>Material Form Elements</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="index.html" tppabs="http://ableproadmin.com/light/vertical/index.html"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Forms</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:if(confirm(%27http://ableproadmin.com/light/vertical/general-elements-materialize.html  \n\nThis file was not retrieved by Teleport Ultra, because the server reports that this file cannot be found.  \n\nDo you want to open it from the server?%27))window.location=%27http://ableproadmin.com/light/vertical/general-elements-materialize.html%27" tppabs="http://ableproadmin.com/light/vertical/general-elements-materialize.html">Material Form Elements</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- Header end -->

            <div class="row">
                <!-- Form Control starts -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Static Labels</h5>
                            <div class="f-right">
                                <a href="" data-toggle="modal" data-target="#static-labels-Modal"><i class="icofont icofont-code-alt"></i></a>
                            </div>
                        </div>
                        <div class="modal fade modal-flex" id="static-labels-Modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title">Code Explanation For Static Labels </h5>
                                    </div>
                                    <!-- end of modal-header -->
                                    <div class="modal-body">
                                  <pre class="brush: html;">
                                            /* For Static Labels */

                                  /* For First Name */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-input-wrapper"&gt;
                                            &lt;input type="text" class="md-form-control md-static" /&gt;
                                            &lt;label&gt;First-Name&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                   /* For Last Name */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-input-wrapper"&gt;
                                            &lt;input type="text" class="md-form-control md-static" /&gt;
                                            &lt;label&gt;Last-Name&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* For Password */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="password" class="md-form-control md-static"/&gt;
                                        &lt;label>Password&lt;label&gt;
                                    &lt;div&gt;

                                    /* For Email Address */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="email" class="md-form-control md-static"/&gt;
                                        &lt;label&gt;Email&lt;label&gt;
                                    &lt;div&gt;

                                    /* For Disable */

                                    &lt;div class="md-input-wrapper md-disable"&gt;
                                        &lt;input type="password" class="md-form-control md-static" disabled="disabled"/&gt;
                                        &lt;label&gt;Disabled&lt;label&gt;
                                    &lt;div&gt;

                                    /* For Read Only */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="text" class="md-form-control md-static" value="Read-only label" readonly/&gt;
                                        &lt;label&gt;Read-only&lt;label&gt;
                                    &lt;div&gt;

                                    /* For Prefill Value */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="text" class="md-form-control md-static" value="Prefill Value"/&gt;
                                        &lt;label&gt;Prefill-value&lt;label&gt;
                                    &lt;div&gt;

                                    /* for addon */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-group-add-on"&gt;
                                            &lt;span class="md-add-on"&gt; &lt;i class="icofont icofont-cur-dollar"&gt;&lt;/i&gt;&lt;/span&gt;
                                            &lt;div class="md-input-wrapper"&gt;
                                                &lt;input type="text" class="md-form-control md-static"/&gt;
                                                &lt;label>Add-on&lt;/label&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* for addon with icon */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-group-add-on"&gt;
                                                &lt;span class="md-add-on"&gt;
                                                    &lt;i class="icofont icofont-ui-rate-blank"&gt;&lt;/i&gt;
                                                &lt;/span&gt;
                                            &lt;div class="md-input-wrapper"&gt;
                                                &lt;input type="text" class="md-form-control md-static"/&gt;
                                                &lt;label>Add-on-icon&lt;/label&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* for upload file */

                                    &lt;div class="md-group-add-on"&gt;
                                        &lt;span class="md-add-on-file"&gt;
                                            &lt;button class="btn btn-success waves-effect waves-light">File&lt;/button&gt;
                                        &lt;/span&gt;
                                        &lt;div class="md-input-file"&gt;
                                            &lt;input type="file" class=""/&gt;
                                            &lt;input type="text" class="md-form-control md-form-file"&gt;
                                            &lt;label class="md-label-file">Upload File&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* for text area */

                                        &lt;div class="md-input-wrapper"&gt;
                                            &lt;textarea class="md-form-control md-static" cols="2" rows="4">&lt;/textarea&gt;
                                            &lt;label>Textarea &lt;/label&gt;
                                        &lt;/div&gt;
                                </pre>
                                    </div>
                                    <!-- end of modal-body -->
                                </div>
                                <!-- end of modal-content -->
                            </div>
                            <!-- end of modal-dialog -->
                        </div>
                        <!-- end of modal -->

                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="md-input-wrapper">
                                        <input type="text" class="md-form-control md-static" />
                                        <label>First-Name</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-input-wrapper">
                                        <input type="text" class="md-form-control md-static" />
                                        <label>Last-Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="md-input-wrapper">
                                <input type="password" class="md-form-control md-static" />
                                <label>Password</label>
                            </div>
                            <div class="md-input-wrapper">
                                <input type="email" class="md-form-control md-static" />
                                <label>Email</label>
                            </div>
                            <div class="md-input-wrapper md-disable">
                                <input type="password" class="md-form-control md-static" disabled="disabled" />
                                <label>Disabled</label>
                            </div>
                            <div class="md-input-wrapper">
                                <input type="text" class="md-form-control md-static" value="Read-only label" readonly/>
                                <label>Read-only</label>
                            </div>
                            <div class="md-input-wrapper">
                                <input type="text" class="md-form-control md-static" value="Prefill Value" />
                                <label>Prefill-value</label>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="md-group-add-on">
                                        <span class="md-add-on"><i class="icofont icofont-cur-dollar"></i></span>
                                        <div class="md-input-wrapper">
                                            <input type="text" class="md-form-control md-static" />
                                            <label>Add-on</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-group-add-on">
                                            <span class="md-add-on">
                                                <i class="icofont icofont-ui-rate-blank"></i>
                                            </span>
                                        <div class="md-input-wrapper">
                                            <input type="text" class="md-form-control md-static" />
                                            <label>Add-on-icon</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md-group-add-on">
                                    <span class="md-add-on-file">
                                        <button class="btn btn-success waves-effect waves-light">File</button>
                                    </span>
                                <div class="md-input-file">
                                    <input type="file" class="" />
                                    <input type="text" class="md-form-control md-form-file">
                                    <label class="md-label-file">Upload File</label>
                                </div>
                            </div>
                            <div class="md-input-wrapper">
                                <textarea class="md-form-control md-static" cols="2" rows="4"></textarea>
                                <label>Textarea </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Floating Labels</h5>
                            <div class="f-right">
                                <a href="" data-toggle="modal" data-target="#floating-labels-Modal"><i class="icofont icofont-code-alt"></i></a>
                            </div>
                        </div>
                        <div class="modal fade modal-flex" id="floating-labels-Modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title">Code Explanation For Floating Labels </h5>
                                    </div>
                                    <!-- end of modal-header -->
                                    <div class="modal-body">
                                  <pre class="brush: html;">
                                            /* For floating Labels */

                                    /* for Floating First Name */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-input-wrapper"&gt;
                                            &lt;input type="text" class="md-form-control"/&gt;
                                            &lt;label&gt;First-Name&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                     /* for Floating Last Name */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-input-wrapper"&gt;
                                            &lt;input type="text" class="md-form-control"/&gt;
                                            &lt;label&gt;Last-Name&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                     /* for Floating Password */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="password" class="md-form-control"/&gt;
                                        &lt;label&gt;Password&lt;/label&gt;
                                    &lt;/div&gt;

                                     /* for Floating Email Address */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="email" class="md-form-control"/&gt;
                                        &lt;label&gt;Email&lt;/label&gt;
                                    &lt;/div&gt;

                                     /* for Floating Disable */

                                    &lt;div class="md-input-wrapper md-disable"&gt;
                                        &lt;input type="text" class="md-form-control" disabled="disabled"/&gt;
                                        &lt;label&gt;Disabled&lt;/label&gt;
                                    &lt;/div&gt;

                                     /* for Floating Read Only */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="text" class="md-form-control md-valid" value="Read-only label" readonly /&gt;
                                        &lt;label&gt;Read-only&lt;/label&gt;
                                    &lt;/div&gt;

                                     /* for Floating Pre-fill Address */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="text" class="md-form-control md-valid" value="Prefilled Value"/&gt;
                                        &lt;label&gt;Pre-fill&lt;/label&gt;
                                    &lt;/div&gt;

                                    /* for Floating Add-on */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-group-add-on"&gt;
                                            &lt;span class="md-add-on"&gt;&lt;i class="icofont icofont-cur-dollar"&gt;&lt;/i&gt;&lt;/span&gt;
                                            &lt;div class="md-input-wrapper"&gt;
                                                &lt;input type="text" class="md-form-control" /&gt;
                                                &lt;label&gt;Add-on&lt;/label&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* for floating add-on icon */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-group-add-on"&gt;
                                                &lt;span class="md-add-on"&gt;
                                                    &lt;i class="icofont icofont-ui-rate-blank"&gt;&lt;/i&gt;
                                                &lt;/span&gt;
                                            &lt;div class="md-input-wrapper"&gt;
                                                &lt;input type="text" class="md-form-control"/&gt;
                                                &lt;label&gt;Add-on-icon&lt;/label&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* for floating upload file */

                                    &lt;div class="md-group-add-on"&gt;
                                        &lt;span class="md-add-on-file"&gt;
                                            &lt;button class="btn btn-success waves-effect waves-light"&gt;File&lt;/button&gt;
                                        &lt;/span&gt;
                                        &lt;div class="md-input-file"&gt;
                                            &lt;input type="file" class=""/&gt;
                                            &lt;input type="text" class="md-form-control md-form-file"&gt;
                                            &lt;label class="md-label-file"&gt;Upload File&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* for floating text-area */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;textarea class="md-form-control" cols="2" rows="4"&gt;&lt;/textarea>
                                        &lt;label>Textarea&lt;/label&gt;
                                    &lt;/div&gt;
                                </pre>
                                    </div>
                                    <!-- end of modal-body -->
                                </div>
                                <!-- end of modal-content -->
                            </div>
                            <!-- end of modal-dialog -->
                        </div>
                        <!-- end of modal -->

                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="md-input-wrapper">
                                        <input type="text" class="md-form-control" />
                                        <label>First-Name</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-input-wrapper">
                                        <input type="text" class="md-form-control" />
                                        <label>Last-Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="md-input-wrapper">
                                <input type="password" class="md-form-control" />
                                <label>Password</label>
                            </div>
                            <div class="md-input-wrapper">
                                <input type="email" class="md-form-control" />
                                <label>Email</label>
                            </div>
                            <div class="md-input-wrapper md-disable">
                                <input type="text" class="md-form-control" disabled="disabled" />
                                <label>Disabled</label>
                            </div>
                            <div class="md-input-wrapper">
                                <input type="text" class="md-form-control md-valid" value="Read-only label" readonly />
                                <label>Read-only</label>
                            </div>
                            <div class="md-input-wrapper">
                                <input type="text" class="md-form-control md-valid" value="Prefilled Value" />
                                <label>Pre-fill</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="md-group-add-on">
                                        <span class="md-add-on"><i class="icofont icofont-cur-dollar"></i></span>
                                        <div class="md-input-wrapper">
                                            <input type="text" class="md-form-control" />
                                            <label>Add-on</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-group-add-on">
                                            <span class="md-add-on">
                                                <i class="icofont icofont-ui-rate-blank"></i>
                                            </span>
                                        <div class="md-input-wrapper">
                                            <input type="text" class="md-form-control" />
                                            <label>Add-on-icon</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md-group-add-on">
                                    <span class="md-add-on-file">
                                        <button class="btn btn-success waves-effect waves-light">File</button>
                                    </span>
                                <div class="md-input-file">
                                    <input type="file" class="" />
                                    <input type="text" class="md-form-control md-form-file">
                                    <label class="md-label-file">Upload File</label>
                                </div>
                            </div>
                            <div class="md-input-wrapper">
                                <textarea class="md-form-control" cols="2" rows="4"></textarea>
                                <label>Textarea</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Placeholder Labels</h5>
                            <div class="f-right">
                                <a href="" data-toggle="modal" data-target="#placeholder-labels-Modal"><i class="icofont icofont-code-alt"></i></a>
                            </div>
                        </div>
                        <div class="modal fade modal-flex" id="placeholder-labels-Modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title">Code Explanation For Placeholder Labels </h5>
                                    </div>
                                    <!-- end of modal-header -->
                                    <div class="modal-body">
                                  <pre class="brush: html;">
                                            /* For Placeholder Labels */

                                    /* for Placeholder first name */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-input-wrapper"&gt;
                                            &lt;input type="text" class="md-form-control" placeholder="First-Name"/&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* for Placeholder last name */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-input-wrapper"&gt;
                                            &lt;input type="text" class="md-form-control" placeholder="Last-Name"/&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* for Placeholder Password */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="password" class="md-form-control" placeholder="Password"/&gt;
                                    &lt;/div&gt;

                                    /* for Placeholder email address */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="email" class="md-form-control" placeholder="Email"/&gt;
                                    &lt;/div&gt;

                                    /* for Placeholder disable */

                                    &lt;div class="md-input-wrapper md-disable"&gt;
                                        &lt;input type="text" class="md-form-control" disabled="disabled" placeholder="Disabled"/&gt;
                                    &lt;/div&gt;

                                    /* for Placeholder read only */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="text" class="md-form-control" placeholder="Read-only Text" readonly /&gt;
                                    &lt;/div&gt;

                                    /* for Placeholder pre-fill */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;input type="text" class="md-form-control" value="Pre-fill value"/&gt;
                                    &lt;/div&gt;

                                    /* for Placeholder add-on */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-group-add-on"&gt;
                                            &lt;span class="md-add-on"&gt;&lt;i class="icofont icofont-cur-dollar"&gt;&lt;/i&gt;&lt;/span&gt;
                                            &lt;div class="md-input-wrapper"&gt;
                                                &lt;input type="text" class="md-form-control" placeholder="Add-on"/&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                     /* for Placeholder add-on icon */

                                    &lt;div class="col-sm-6"&gt;
                                        &lt;div class="md-group-add-on"&gt;
                                                &lt;span class="md-add-on"&gt;
                                                    &lt;i class="icofont icofont-ui-rate-blank"&gt;&lt;/i&gt;
                                                &lt;/span&gt;
                                            &lt;div class="md-input-wrapper"&gt;
                                                &lt;input type="text" class="md-form-control" placeholder="Add-on-icon"/&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* for Placeholder file upload */

                                    &lt;div class="md-group-add-on"&gt;
                                        &lt;span class="md-add-on-file"&gt;
                                            &lt;button class="btn btn-success waves-effect waves-light"&gt;File&lt;/button&gt;
                                        &lt;/span&gt;
                                        &lt;div class="md-input-file"&gt;
                                            &lt;input type="file" class=""/&gt;
                                            &lt;input type="text" class="md-form-control md-form-file"&gt;
                                            &lt;label class="md-label-file"&gt;Upload File&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;

                                    /* for Placeholder Text Area */

                                    &lt;div class="md-input-wrapper"&gt;
                                        &lt;textarea class="md-form-control" cols="2" rows="3" placeholder="Type your keywords"&gt;&lt;/textarea&gt;
                                    &lt;/div&gt;
                                </pre>
                                    </div>
                                    <!-- end of modal-body -->
                                </div>
                                <!-- end of modal-content -->
                            </div>
                            <!-- end of modal-dialog -->
                        </div>
                        <!-- end of modal -->

                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="md-input-wrapper">
                                        <input type="text" class="md-form-control" placeholder="First-Name" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-input-wrapper">
                                        <input type="text" class="md-form-control" placeholder="Last-Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="md-input-wrapper">
                                <input type="password" class="md-form-control" placeholder="Password" />
                            </div>
                            <div class="md-input-wrapper">
                                <input type="email" class="md-form-control" placeholder="Email" />
                            </div>
                            <div class="md-input-wrapper md-disable">
                                <input type="text" class="md-form-control" disabled="disabled" placeholder="Disabled" />
                            </div>
                            <div class="md-input-wrapper">
                                <input type="text" class="md-form-control" placeholder="Read-only Text" readonly />
                            </div>
                            <div class="md-input-wrapper">
                                <input type="text" class="md-form-control" value="Pre-fill value" />
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="md-group-add-on">
                                        <span class="md-add-on"><i class="icofont icofont-cur-dollar"></i></span>
                                        <div class="md-input-wrapper">
                                            <input type="text" class="md-form-control" placeholder="Add-on" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-group-add-on">
                                            <span class="md-add-on">
                                                <i class="icofont icofont-ui-rate-blank"></i>
                                            </span>
                                        <div class="md-input-wrapper">
                                            <input type="text" class="md-form-control" placeholder="Add-on-icon" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md-group-add-on">
                                    <span class="md-add-on-file">
                                        <button class="btn btn-success waves-effect waves-light">File</button>
                                    </span>
                                <div class="md-input-file">
                                    <input type="file" class="" />
                                    <input type="text" class="md-form-control md-form-file">
                                    <label class="md-label-file">Upload File</label>
                                </div>
                            </div>
                            <div class="md-input-wrapper">
                                <textarea class="md-form-control" cols="2" rows="3" placeholder="Type your keywords"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Form States</h5>
                            <div class="f-right">
                                <a href="" data-toggle="modal" data-target="#form-states-Modal"><i class="icofont icofont-code-alt"></i></a>
                            </div>
                        </div>
                        <div class="modal fade modal-flex" id="form-states-Modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title">Code Explanation For Form States </h5>
                                    </div>
                                    <!-- end of modal-header -->
                                    <div class="modal-body">
                                  <pre class="brush: html;">
                                            /* For Form States */

                                /* For Primary Labels */

                                &lt;div class="col-sm-4"&gt;
                                    &lt;div class="md-input-wrapper md-input-primary"&gt;
                                        &lt;input type="text" class="md-form-control"/&gt;
                                        &lt;label&gt;Primary Label&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                /* For Success Labels */

                                &lt;div class="col-sm-4"&gt;
                                    &lt;div class="md-input-wrapper md-input-success"&gt;
                                        &lt;input type="text" class="md-form-control" /&gt;
                                        &lt;label&gt;Success Label&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                /* For Warning Labels */

                                &lt;div class="col-sm-4"&gt;
                                    &lt;div class="md-input-wrapper md-input-warning"&gt;
                                        &lt;input type="text" class="md-form-control"/&gt;
                                        &lt;label&gt;Warning Label&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                /* For Danger Labels */

                                &lt;div class="col-sm-4"&gt;
                                    &lt;div class="md-input-wrapper md-input-danger"&gt;
                                        &lt;input type="text" class="md-form-control"/&gt;
                                        &lt;label&gt;Danger Label&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                /* For Info Labels */

                                &lt;div class="col-sm-4"&gt;
                                    &lt;div class="md-input-wrapper md-input-info"&gt;
                                        &lt;input type="text" class="md-form-control"/&gt;
                                        &lt;label&gt;Info Label&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                              </pre>
                                    </div>
                                    <!-- end of modal-body -->
                                </div>
                                <!-- end of modal-content -->
                            </div>
                            <!-- end of modal-dialog -->
                        </div>
                        <!-- end of modal -->

                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-input-wrapper md-input-primary">
                                        <input type="text" class="md-form-control" />
                                        <label>Primary Label</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-input-wrapper md-input-success">
                                        <input type="text" class="md-form-control" />
                                        <label>Success Label</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-input-wrapper md-input-warning">
                                        <input type="text" class="md-form-control" />
                                        <label>Warning Label</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-input-wrapper md-input-danger">
                                        <input type="text" class="md-form-control" />
                                        <label>Danger Label</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-input-wrapper md-input-info">
                                        <input type="text" class="md-form-control" />
                                        <label>Info Label</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Form Control ends -->
            </div>
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Form Select</h5>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="sub-title">Select
                                        <a href="" class="f-right" data-toggle="modal" data-target="#form-select-Modal">
                                            <i class="icofont icofont-code-alt"></i>
                                        </a>
                                    </div>
                                    <div class="modal fade modal-flex" id="form-select-Modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title">Code Explanation For Select Single value </h5>
                                                </div>
                                                <!-- end of modal-header -->
                                                <div class="modal-body">
                                              <pre class="brush: html;">

                                                /* for Single Value Select */

                                                &lt;div class="md-input-wrapper"&gt;
                                                    &lt;select class="md-form-control"&gt;
                                                        &lt;option&gt;Select&lt;/option&gt;
                                                        &lt;option&gt;2&lt;/option&gt;
                                                        &lt;option&gt;3&lt;/option&gt;
                                                        &lt;option&gt;4&lt;/option&gt;
                                                        &lt;option&gt;5&lt;/option&gt;
                                                    &lt;/select&gt;
                                                &lt;/div&gt;

                                                &lt;div class="md-form-group"&gt;
                                                    &lt;div class="materialSelect md-input-wrapper inline empty w-100"&gt;
                                                        &lt;ul class="md-select md-form-control"&gt;
                                                            &lt;li data-selected="true"&gt;Choose something...&lt;/li&gt;
                                                            &lt;li data-value="0"&gt;First option&lt;/li&gt;
                                                            &lt;li data-value="1"&gt;Second option&lt;/li&gt;
                                                            &lt;li data-value="2"&gt;Third option&lt;/li&gt;
                                                        &lt;/ul&gt;
                                                        &lt;div class="message"&gt;Please select something&lt;/div&gt;
                                                    &lt;/div&gt;
                                                &lt;/div&gt;
                                              </pre>
                                                </div>
                                                <!-- end of modal-body -->
                                            </div>
                                            <!-- end of modal-content -->
                                        </div>
                                        <!-- end of modal-dialog -->
                                    </div>
                                    <!-- end of modal -->

                                    <div class="md-input-wrapper">
                                        <select class="md-form-control">
                                            <option>Select</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="md-form-group">
                                        <div class="materialSelect md-input-wrapper inline empty w-100">
                                            <ul class="md-select md-form-control">
                                                <li data-selected="true">Choose something...</li>
                                                <li data-value="0">First option</li>
                                                <li data-value="1">Second option</li>
                                                <li data-value="2">Third option</li>
                                            </ul>
                                            <div class="message">Please select something</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="sub-title">Multi-Select
                                        <a href="" class="f-right" data-toggle="modal" data-target="#multi-select-Modal">
                                            <i class="icofont icofont-code-alt"></i>
                                        </a>
                                    </div>
                                    <div class="modal fade modal-flex" id="multi-select-Modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title">Code Explanation For Select Multiple value </h5>
                                                </div>
                                                <!-- end of modal-header -->
                                                <div class="modal-body">
                                              <pre class="brush: html;">
                                                /* use for multiple select value */

                                                &lt;div class="md-input-wrapper"&gt;
                                                    &lt;select class="md-form-control multiple-select" multiple&gt;
                                                        &lt;option&gt;1&lt;/option&gt;
                                                        &lt;option&gt;2&lt;/option&gt;
                                                        &lt;option&gt;3&lt;/option&gt;
                                                        &lt;option&gt;4&lt;/option&gt;
                                                        &lt;option&gt;5&lt;/option&gt;
                                                    &lt;/select&gt;
                                                &lt;/div&gt;
                                              </pre>
                                                </div>
                                                <!-- end of modal-body -->
                                            </div>
                                            <!-- end of modal-content -->
                                        </div>
                                        <!-- end of modal-dialog -->
                                    </div>
                                    <!-- end of modal -->

                                    <div class="md-input-wrapper">
                                        <select class="md-form-control multiple-select" multiple>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!--  <h6 class="sub-title">Disable Select</h6> -->
                                    <div class="sub-title">Disable Select
                                        <a href="" class="f-right" data-toggle="modal" data-target="#disable-select-Modal">
                                            <i class="icofont icofont-code-alt"></i>
                                        </a>
                                    </div>
                                    <div class="modal fade modal-flex" id="disable-select-Modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title">Code Explanation For Disable Select value </h5>
                                                </div>
                                                <!-- end of modal-header -->
                                                <div class="modal-body">
                                              <pre class="brush: html;">
                                                /* use for Disable Select */

                                                &lt;div class="md-input-wrapper"&gt;
                                                    &lt;select class="md-form-control md-disable" disabled&gt;
                                                        &lt;option&gt;Select&lt;/option&gt;
                                                        &lt;option&gt;2&lt;/option&gt;
                                                        &lt;option&gt;3&lt;/option&gt;
                                                        &lt;option&gt;4&lt;/option&gt;
                                                        &lt;option&gt;5&lt;/option&gt;
                                                    &lt;/select&gt;
                                                &lt;/div&gt;
                                              </pre>
                                                </div>
                                                <!-- end of modal-body -->
                                            </div>
                                            <!-- end of modal-content -->
                                        </div>
                                        <!-- end of modal-dialog -->
                                    </div>
                                    <!-- end of modal -->
                                    <div class="md-input-wrapper">
                                        <select class="md-form-control md-disable" disabled>
                                            <option>Select</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid ends -->
    </div>
</div>


  <?php include('footer.php'); ?>