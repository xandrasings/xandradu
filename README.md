# Command Naming Scheme
### Reconcile
- purpose 
  - uses external data to create (sometimes delete, depending on the external system's design) or update internal data 
- name scheme 
  - named after the relevant Dto
- accepts 
  - a dto representing the external data
  - a parent model to attach the target model to (if applicable)
- returns 
  - the target model
### AllReconcile
### Trash
### AllTrash
### AllSync
### AllSyncDown
### SyncDown
### AllSyncUp
### SyncUp
### Create
### Manifest
### Locate
### Retrieve
