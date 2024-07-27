# skyblock.fflnvb.de

This project will be a supercollection of data for the Skyblock Economy Server.
It is based on Laravel and will grow in functionalities.

## Features

The following features are already implemented

- Monitor `Presences` of `Players`
- Retrieve Mojang UUID for `Players`
- Notify subscribed `Players` via Telegram on disconnect

## Terminology

For better communication there are strict terms that need to be used throughout the code and communication

### Minecraft

A 2011 released sandbox game with blocks and crafting developed by Notch/Mojang, now owned by Microsoft.

### Skyblock

A Minecraft map/gamemode invented by Noobcrew in 2011 with a small island in a void.
Here it also refers to the Server by Noobcrew offering a skyblock multiplayer experience.
The focus of this project is upon the economy server, which has a currency called Skybucks.

### Player

A Minecraft account/character acquired and used by a human to play minecraft.

### Presence

A timeframe on which a player was being online on a server.
A presence does not require being active. A Player can also AFK (Away From Keyboard).

### PresenseSubscription

An order to monitor presences of a given player, containing information on who to observe.

### joining

The transfer from being offline to online in perspective of a server.

### leaving

The transfer from being online to offline in perspective of a server.

### registering a Player

Getting a permanent ID assigned to a player by Mojang.

### registering a Presence

The process of creating a presence or closing it by comparing data of the Skyblock API

### Mojang API

A collection of API endpoints offering functions like name<->id converter.

### Skyblock API

Endpoints provided by Skyblock to gain information about the server.

### Java-Edition

The original Minecraft game playable on Mac OS, Linux and Windows.

### Bedrock-Edition

A remake with focus on support for Windows, Mobile Devices and Game Consoles with the same features as the Java Edition.
The Skyblock server is based on the Java-Edition. Previously, crossplay between Java- and Bedrock-edition was not possible.

With a modded server also Bedrock Players are able to play on Skyblock.
The Bedrock edition is harder to mod and deeply connected to the Windows ecosystem.
