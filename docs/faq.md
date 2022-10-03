## FAQ

__What is the Advanced Click Object?__
Advanced Click Objects are used to fetch data from child or parent objects of the actual clickElement. 
#code
<p class="parent" parent-meta="the parent data">
   <span class="child" child-meta="the child data"></span>
<p>


__What is the issue with custom Javascript variables?__
So instead of creating custom Javascript variables to do things like: 
MatomoTagManager.dataLayer.get('mtm.clickElement').parentElement.getAttribute("style")
we have a more controlled way of getting this type of data
The issue with custom Javascrips is that you must add a lot of logic to test that the attributes exists otherwise you will get a lot of errors in the console.
These validations are built in into the plugin to make your code clean.

