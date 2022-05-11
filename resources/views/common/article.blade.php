@extends('layouts.general')

@section('body-section')

<div class="d-flex justify-content-center my-5">
    <div class="shadow-lg" id="adobe-dc-view" style="width: 800px;"></div>
</div>

<section>
  <div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-10 col-xl-8">
        <div class="card shadow-lg">
          <div class="card-body p-4">
            <div class="row">
              <div class="col">
                <div class="d-flex flex-start">
                  <img class="rounded-circle shadow-1-strong me-3"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" alt="avatar" width="65"
                    height="65" />
                  <div class="flex-grow-1 flex-shrink-1">
                    <div>
                      <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-1">
                          Maria Smantha <span class="small">- 2 hours ago</span>
                        </p>
                        <a href="#!" class="text-decoration-none"><i class='bx bxs-share text-accent' ></i><span class="small"> reply</span></a>
                      </div>
                      <p class="small mb-0">
                        It is a long established fact that a reader will be distracted by
                        the readable content of a page.
                      </p>
                    </div>

                    <div class="d-flex flex-start mt-4">
                      <a class="me-3" href="#">
                        <img class="rounded-circle shadow-1-strong"
                          src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp" alt="avatar"
                          width="65" height="65" />
                      </a>
                      <div class="flex-grow-1 flex-shrink-1">
                        <div>
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-1">
                              Simona Disa <span class="small">- 3 hours ago</span>
                            </p>
                          </div>
                          <p class="small mb-0">
                            letters, as opposed to using 'Content here, content here',
                            making it look like readable English.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="d-flex flex-start mt-4">
                  <img class="rounded-circle shadow-1-strong me-3"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(12).webp" alt="avatar" width="65"
                    height="65" />
                  <div class="flex-grow-1 flex-shrink-1">
                    <div>
                      <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-1">
                          Natalie Smith <span class="small">- 2 hours ago</span>
                        </p>
                        <a href="#!" class="text-decoration-none"><i class='bx bxs-share text-accent' ></i><span class="small"> reply</span></a>
                      </div>
                      <p class="small mb-0">
                        The standard chunk of Lorem Ipsum used since the 1500s is
                        reproduced below for those interested. Sections 1.10.32 and
                        1.10.33.
                      </p>
                    </div>

                    <div class="d-flex flex-start mt-4">
                      <a class="me-3" href="#">
                        <img class="rounded-circle shadow-1-strong"
                          src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(31).webp" alt="avatar"
                          width="65" height="65" />
                      </a>
                      <div class="flex-grow-1 flex-shrink-1">
                        <div>
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-1">
                              Lisa Cudrow <span class="small">- 4 hours ago</span>
                            </p>
                          </div>
                          <p class="small mb-0">
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
                            scelerisque ante sollicitudin commodo. Cras purus odio,
                            vestibulum in vulputate at, tempus viverra turpis.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>

<script type="text/javascript">
	document.addEventListener("adobe_dc_view_sdk.ready", function(){ 
		var adobeDCView = new AdobeDC.View({clientId: "39d623d0bca34c73ba77454131227cf3", divId: "adobe-dc-view"});
		adobeDCView.previewFile({
            content: {location: {url: "{{ URL::asset('sample.pdf'); }}"}},
			metaData:{fileName: "sample.pdf"}
		}, {embedMode: "IN_LINE", showDownloadPDF: false, showPrintPDF: false});
	});
</script>

@endsection