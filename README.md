# Matomo DigiTracking Plugin

## Description

This plugin will make your Matomo Tag Manager life easier.

# DigiTracking

## Tags

### AutoTracker
This tag will give you several pre configured event tracking options for outlinks, downloads, mail clicks ans phone link clicks. Just enable the tracking you want and execute it on pageviews. If you want different logic on different pages you can set up several tags that will execute on different parts of the site.

### DataAttributeTracking
This Tag will enable you to do event tracking on your site just by adding data attributes to you html elements. 
Like:

`<button data-event-category="Click" data-event-action="Button" data-event-name="Data attribute test" data-event-value="10" >Data attribute test</button>`

## Variables

### AdvancedClickObjects
This variable will heplp you to get data from other html elements than the actual clickElement using relative querySelectors. So finally you can read that meta-data from a buttons parent element or a lot more advanced scenarios.
So in the case below you can create a variable to get the values from [meta-data] or [child-meta] or basically anything. 
'<div class="the-parent" meta-data="the-value">
  <button>clickElement
    <span class="the-child" child-meta="child-value"></span>
  </button>
 </div> '
 

