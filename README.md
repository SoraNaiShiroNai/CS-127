# CS-127

Project Buy and Sell: Reader's Exchange

2019/05/28

Members:
Buenaventura, John Fhilippe
Lim, Romelle
Matabang, Arvin


# Features
The main page (home_page.php) lists the top 12 entries for SALE and AUCTION. 
An unregistered user will only have access to the listing of items, the expanded details, and the option to log in or sign up for a new account. 

Registered users gain access to post new items either on sale or auction, access to their own dashboards and history records, the ability to buy items on sale and the participate on auction.

The Dashboard lists all the features a registered user can do: View active auctions the user has participated in, View their history records, mark an item as delivered, view all the pending items, and check the status of the items they sell/sold.

The site also automatically notifies the users whether the items they posted were bought, and the items they bought were successfully processed. 

Users are also allowed to place bids on items posted auctions and view the bids of other bidders and the highest bid placed. 

Users who posted bids are not allowed to edit the starting price of the items once another user has placed a bid on the item, likewise, a users who posted bids are not allowed to edit any data at all once the bid has been closed.

The search bars in various pages links to the listing.php page where all the results are gathered (both in sale and in auction). There is also an option to use a search bar in listing.php and history.php which uses AJAX for search.

When the items are bought, the item is placed on the Dashboard and when it's delivered, it is then transferred to the history page.

# Applications Used

XAMPP phpmyadmin as a relational database

