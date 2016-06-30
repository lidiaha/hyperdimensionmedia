# 2016 Hypermedia University project

## Assignment

The goal of this project is to implement a functional version of the website (a fake, unofficial version)
for TIM (an italian telco), according to the specification received during the university course.

## Project structure

* DB contains the .sql database to be imported, for the website to be fully functional
* WEBSITE contains a php-heavy version of the site, which is more friendly to the developers
* WEBSITE-static-web contains a html-heavy auto-generated version of the previous one, intended
    for deployment on the production webservers
* WEBSITE-static-phonegapp contains a html-heavy auto-generated version of WEBSITE, intended for
    deployment via the PhoneGap platform. All the file paths here are android-specific
* README.md this file
* notes.txt partial roadmap for the earliest phases of the project, not much used after that

## Frameworks / libraries used

The "library files" for javascript and php are contained, respectively, in the sub-folders
jslib/ and phplib/

Other than jQuery, no major framework is employed.  
Other third-party libraries include:

* parallax.js (for the scrolling background)
* js.cookie (nice wrapper around cookie-handling functions)
* simple_html_dom (sort of jquery for php, rerely used in the project)

## Useful notes

We implemented a custom php script to handle the generation of static html code from our
"mother code tree", which heavily employs the <?php include "file" ?> pattern,
in order to make developement easier.

The script is intended to work on the developement webservers only, and is activated by
visiting either php/phonebaka.php or php/phonebaka.php?phonegap

The script mostly works by rebuilding the source tree in this way: all the user-facing
.php pages are converted into .html, by replacing the <?php include "file" ?> with the
actual static content.  
The actual web server takes care of this job for us. Then, all the old reference (links
and urls) to the old .php pages are updated to point to the correct new .html page.

In the case of the phonegap build, the paths are also corrected to work correctly on a
local android file-structure.  
(Of course, if we wanted to target the iOS platform, this code should be modified and extended)

The pages themselves need however to be designed with phonegapp-compatibility in mind:
to simplify the retrieval of remote content via ajax, includer.js was implemented

## Project members

* Lidia Moioli
* Michele Madaschi
