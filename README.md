# Topfield_TF600_API
Unofficial JSON API for Topfield TF600, what get data from Topfield digibox's WLAN web interface.

## Tested with

* **Topfield TF600PVRc**
* Downloading Software Version (translate (not that the box says)) **C1.19**
* Laiteversio (3rd in Receiver Status menu) **5.4.0**
* Software Version **TF-NNPCCF 3.19**
* Laiteversio (5rd in Receiver Status Menu) **v.1.00**
* Last update **January 14 2008**

## How to use
This don't have much features (more is coming), but there are current features:

### Get channel list
`http://path.to/your.api/channels`

Example response:
```
{
    "1": {
        "id": "1",
        "name": "Yle TV1"
    },
    "2": {
        "id": "2",
        "name": "Yle TV2"
    },
    "3": {
        "id": "3",
        "name": "MTV3"
    },
    "4": {
        "id": "4",
        "name": "Nelonen"
    }
}
```

### Get harddisk usage
`http://path.to/your.api/harddisk`

Example response:
```
{
    "total_space": "305242",
    "occupied_space": "302302",
    "used_space": 299362,
    "free_space": "2940"
}
```
The values are in megabytes.

### Get box time
`http://path.to/your.api/harddisk`

Example response:
```
{
    "year": "2016",
    "month": "12",
    "day": "20",
    "hour": "15",
    "minute": "43",
    "second": "49"
}
```