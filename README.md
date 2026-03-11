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

Reconcile
- accepts DTO representing a resource from an external system
- creates or updates the corresponding Model in the internal system
- may require some flags for children

Manifest
- accepts Model from the internal system
- calls Create, Update, or Delete action where appropriate
- may require some flags for children

Create
- accepts Model from the internal system
- makes API call to create paired resource in an external system
- updates Model to reflect the external id
- may require some flags for children

Update

Delete

AllSyncDown
- accepts nothing
- makes API call to get all resources in an external system
- calls Manifest action on each, to create, update, or delete the Model where appropriate
- may use additional logic to seek out deletable records if external system doesn't use soft deletes
