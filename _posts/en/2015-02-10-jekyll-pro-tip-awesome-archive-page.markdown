---
title: "Jekyll pro tip: how to design an awesome Archive page."
layout: post
published: true
comments: true
category: Jekyll
headimg_url: /images/wikicommons/1024px-Dr_Jekyll_and_Mr_Hyde_poster_edit2.jpg
headimg_lic: "Par Chicago : National Prtg. & Engr. Co. Modifications by Papa Lima Whiskey [CC BY-SA 3.0], via Wikimedia Commons"
headimg_lic_url: http://commons.wikimedia.org/wiki/File:Dr_Jekyll_and_Mr_Hyde_poster_edit2.jpg?uselang=fr
---
*(TL;DR) I explain how I designed my dynamic [Archive page](/archive) using Jekyll+Liquid syntax logic and a bit of CSS. ([Jump to the demo bit](#demo))*

Today, I wanted to sort my posts into categories, so as to have a more organised weblog overall.  
Jekyll handles categories pretty well actually. One has to add a `category: foo` line (*foo* being a category name) in the YAML head of a post, and that's it! (use `categories: [foo1,foo2]` if you set more than one category to a post).

The difficult part is to setup a page that would allow the user to filter posts by categories.  
I did stumble upon some Jekyll plugins that can automatically generate category indexes, which is quite practical indeed. I did not want, however, to use any plugin. That is why I had to try do something with liquid tags only. Also, the idea was to have only *one* page do the work.

---

## The liquid logic

We have main 3 objectives:

* Design a navigation section — It consists of a list of links, each for a category that exists. The links will actually be anchors.
* Display the entire list of posts in a bloc — Because a user may want to navigate through a pure, chronologicaly ordered, list of your posts. And also because some of your posts may have no category attached to them, they would need to be shown somewhere.
* Display a list of posts **for each category**.

You get the idea: we have navigation links to switch between a entire feed of your posts or between your categories ; and below them is displayed the chosen feed or category.  
This way, the user can easily navigate through all your posts and their categories without having to deal with multiples pages.

* **The navigation section.**

{% highlight html linenos %}{% raw %}
<nav>
    <a href="#allposts">All posts</a>
    {% for category in site.categories %}
        <a href="#{{ category | first | remove:' ' }}"><strong>{{ category | first }}</strong></a> {% if forloop.last %}.{% else %}, {% endif %}
    {% endfor %}
</nav>
{% endraw %}
{% endhighlight %}

**Line 2**, we include a static link pointing to `#allposts`. When clicked, it will display the entire, unfiltered, list of posts.  
**Lines 3 to 5**, We're using a *loop* to get all categories, and for each `category` create a link.  

Each link points to {% raw %}`#{{ category | first | remove:' ' }}`{% endraw %}. Those parameters passed to {% raw %}`{{ category }}`{% endraw %} help creating an *anchor-proof* string from the category name.  
For example, for a category named "*My Travels around the world*", the above will output : `#mytravelsaroundtheworld`.  
***Note**: We will use the same liquid tag to define the bloc IDs to which the links we just created point to.*

* **The entire, unfiltered, list of posts**

{% highlight html linenos %}
{% raw %}
<div class="catbloc" id="allposts">
    <h2>All posts</h2>
    
        <ul>
            {% for post in site.posts %}
                <li>
                    <a href="{{ post.url }}">
                    <time>{{ post.date | date: "%-d %B %Y" }}</time>
                    {{ post.title }}
                    </a>
                </li>
            {% endfor %}
        </ul>
</div>
{% endraw %}
{% endhighlight %}

This is no rocket science. If you use Jekyll, you've probably done something like that to display a chronological list of all your posts.

What is important here, **Line 1**, is to surround the usual loop with a `div` whose ID is `allposts` (Remember we set a link pointing to `#allposts` in the navigation section).  
The class `catbloc` is quite important too. It must be the same for this bloc and all of the category blocs, which we will deal with right below.

* **The category sections**

Now, for each category, we will list the posts it contains (the loop used **Line 1**):

{% highlight html linenos %}{% raw %}
{% for category in site.categories %}
    <div class="catbloc" id="{{ category | first | remove:' ' }}">
        <h2>{{ category | first }}</h2>
        
        <ul>
           {% for posts in category %}
             {% for post in posts %}
               {% if post.url %}
                 <li>
                   <a href="{{ post.url }}">
                     <time>{{ post.date | date: "%-d %B %Y" }}</time>
                     {{ post.title }}
                   </a>
                 </li>
               {% endif %}
             {% endfor %}
           {% endfor %}
        </ul>
    </div>
{% endfor %}
{% endraw %}{% endhighlight %}

Note, **on Line 2**, we're setting the id of the bloc to our same *anchor-proof* string made from the category name (without the `#`, this time, of course).

## The CSS switching mechanism

We only want our navigation section to be permanently on screen. We want the other sections to appear **only if we click the link pointing to them**.  
I will be using here the `:target` CSS pseudo-class.

{% highlight css %}
.catbloc:not(:target) {
    display: none;
}
{% endhighlight %}

That's… basically it.  
The situation described here is that any element whose class is set to `catbloc`, and that is not being targeted by any anchor, won't be displayed.

In other words, to make a section appear, the user has to click the link that points to its anchor.

* **Have a demo**{: id="demo"}

<iframe width="100%" height="300" src="https://jsfiddle.net/schoewilliam/trbkq2th/3/embedded/result,html,css/" allowfullscreen="allowfullscreen" frameborder="0"></iframe>

* **And with a bonus CSS animation**

<iframe width="100%" height="300" src="https://jsfiddle.net/schoewilliam/trbkq2th/6/embedded/result,html,css/" allowfullscreen="allowfullscreen" frameborder="0"></iframe>

## Done

I like this layout a lot. I think this is both great functionality and great UX at a really low cost.
Feel free to tell me what you think.