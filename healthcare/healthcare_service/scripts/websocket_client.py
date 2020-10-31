#!/usr/bin/env python
# WS client example

import asyncio
import websockets

async def hello():
    uri = "ws://localhost:443"
    async with websockets.connect(uri) as websocket:
        
        name = '{"state":"authen","type":"response","value":"get_id","data": {"id":"device0002"} } '
        await websocket.send(name)

    
    greeting = await websocket.recv()
    print(f"< {greeting}")


asyncio.get_event_loop().run_until_complete(hello())
asyncio.get_event_loop().run_forever()
