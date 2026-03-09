<div>

    <x-input-error-messages/>
       <!-- Content -->



   <div class="container-xxl">
     <div class="authentication-wrapper authentication-basic container-p-y">
       <div class="authentication-inner py-6">
         <!-- Login -->
         <div class="card">
           <div class="card-body">
             <!-- Logo -->
             <div class="app-brand justify-content-center mb-6">
               <a href="#" class="app-brand-link">
                
   </span>
                 <span class="app-brand-text demo text-heading fw-bold">VINE INT'L SUITES, ABUJA </span>
               </a>
             </div>
             <!-- /Logo -->
             <h5 class="mb-1">Role and Access Authorization Page 🔒</h5>

<p>

   <form>
       @csrf
               <div class="mb-6">
                 <label for="email" class="form-label">User's Fullname</label>
                 <input wire:model='name' type="text" class="form-control" id="fullname"  placeholder="Enter fullname of G.M" autofocus>
               </div>

               <div class="mb-6">
                   <label for="email" class="form-label">User's Email<strong style="color: red">* </strong></label>
                   <input wire:model='email' type="text" class="form-control" id="email" placeholder="Emailwill serve as username" autofocus>
                 </div>
               <div class="mb-6 form-password-toggle">
                 <label class="form-label" for="password">Choose Password</label>
                 <div class="input-group input-group-merge">
                   <input wire:model='password' type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                   <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                 </div>
               </div>

               <div class="mb-6">
                 <button wire:click='createUser' type="button" class="btn btn-primary d-grid w-100" >Create Account</button>
                 <x-app-loader> Creating Account...</x-app-loader>

               </div>
             </form>
             <div class="col-12">
               <div class="form-check form-switch">
                 <input type="checkbox" checked class="form-check-input" id="futureAddress" />
                 <label for="futureAddress" class="switch-label">Assign  User <strong>General Manager's</strong> Role & Rights.</label>



                 <div class="mb-6">
                   <label for="email" class="form-label"> User will update their account personal info later</label>

                 </div>

               </div>
           </div>


           </div>
         </div>
         <!-- /Register -->
       </div>
     </div>
   </div>

   <!-- / Content -->


</div>
