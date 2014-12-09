Secret Santa Website
==================

This was originally created for The Indie Stone secret santa program on the forums. It went over fairly well but I figured I would extend the functionality of the site and allow it to be used in a more general manner, so people could throw this site on their server and just have a go of it.

It currently uses Steam as a login for members since the Secret Santa program was done in exchange for games, so this is obviously a very game cenetred program rather than a general secret santa program. Some of the things requires messing around in the code or the database. Which is obviously not the best way of doing things, so I'm going to aim to resolve that before moving on to my next project.

As I said this is a very gaming centric secret santa, you shouldn't be using this for regular secret santa since it's specifically integrated for use with Steam. If you're interested in the process and what was used then feel free to read on.


Server Setup
==================

I used a LAMP setup server (Linux Apache MySQL PHP) I've heard good things about nginx but I haven't really looked at it and I'm not so versed in the ways of Apache already, that I generally don't have much of an opinion of one or the other. I'm currently at the knowledge of they both do what I want, so I'm not fussed about moving it over.

This was also my first major PHP project, so I'm very much still a learner doing all this in their spare time. I'm sure there are some things you don't find desireable or irritating or unsecure and if you do then please tell me! Or even better do a little pull and push. :)

I used the Steam Authentication system by SmItH197 https://github.com/SmItH197/SteamAuthentication

I have included it in here as well, but you should go read up on it so that you set it up correctly, as I won't talk about it here.

I have included a config file which can be used to set some basic things, such as your connection to a MySQL database and such.

The Story...
==================

So yeah, this was originally created for The Indie Stone as a way to help facilitate an easier way of conducting a secret santa. The original plan was to just use Google Docs, but one night after doing a lot of mind numbing coursework I just decided fuck it, learned what PHP I could, then went to work.

I imagine my code is not terribly desirable and that I'm cool with, I don't really use functions or classes in it mainly because I didn't see much point but I could be horrifically wrong about that.

It seemed to be able to do the job, as I said though it did lack some functionality that required direct code interaction or database messing about, which means over the coming weeks I'll add more functionality to the site and move onto the next project.

Enjoy!

Credits
==================

Connall Lindsay (Me) - For developing the systems in place.

Kirrus - Helped with certain features that was for The Indie Stone community only, unfortunately the features never worked. Still <3 for the help.

Nasko - For pointing out the spelling error I should have noticed.

Rathlord - For having a bash about the website so I could make sure it was working for others.

RoboMatt & EnigmaGrey - For helping in the discussions about the Secret Santa

<3 to The Indie Stone community in general :)
