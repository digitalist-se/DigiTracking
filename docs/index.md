## Documentation

Advanced Click Objects are used to fetch data from child or parent objects of the actual clickElement. 
Example:
A common issue is that when someone clicks the Link below you will be eble to get data directly from the link <a> in it self with the variables {{ClickText}} or {{ClickDestinationUrl}} , but in many cases the data we want to use is somewhere eles in the code. To get that kind of data we need to write custom Javascript variables, wich is always a risk since we often end up having JS errors because of lack of validation etc. 
<p class="parent-parent" parent-parent-meta="the parent data">
    <p class="parent" parent-meta="the parent data">
        <a href="https://matomo.org"> 
            <span class="child" child-meta="the child data">A link to Matomo </span>
        </a>
    </p>
</p>

With the Advanced Click Object we now can create a variable that will hold the data of [parent-parent-meta],  [parent-meta] or [child-meta] with just some simple query selectors.

The variable has some built in validator functions so if the data / elements dont exist you will never get any JS errors.


