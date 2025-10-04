# Command Naming Scheme

Apply
- accepts an external payload
- Instantiate, Update, or Delete

// TODO can this be replaced by SyncDown?
Create
- Fetch
- Instantiate

Fetch
- gets a payload from an external system

Instantiate
- accepts a payload (external or business logic)
- creates the model in data
- returns the model

Manifest
- build something externally and in data based on business logic

SyncDown
- Fetch
- Apply
