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

                 <span class="app-brand-text demo text-heading fw-bold">VINE INT'L SUITES, ABUJA </span>
               </a>
             </div>


             <!-- /Logo -->
             <h5 class="mb-1">Login Page 🔒</h5>
<p>
 <form>
       @csrf

               <div class="mb-6">
                   <label for="email" class="form-label">Username | Email<strong style="color: red">* </strong></label>
                   <input wire:model='email' type="text" class="form-control" id="email" placeholder="Email will serve as username" autofocus>
                 </div>
               <div class="mb-6 form-password-toggle">
                 <label class="form-label" for="password">Enter Password</label>
                 <div class="input-group input-group-merge">
                   <input wire:model='password' type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                   <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                 </div>
               </div>

               <div class="mb-6">
                 <button wire:click='loginUser' type="button" class="btn btn-primary d-grid w-100" >Login In</button>
                 <x-app-loader> Login in...</x-app-loader>

               </div>
             </form>
           </div>
         </div>
         <!-- /Register -->
       </div>
     </div>
   </div>

   <!-- / Content -->


</div>
