# Command Naming Scheme
### AllSync
### SyncDown
### AllSyncDown
### SyncUp
### AllSyncUp
### Reconcile
- purpose 
  - uses external data payload representing an external object to create or update (or sometimes delete, depending on whether the external system provides deleted objects) internal data that represents the roughly equivalent Model (and its relations)
  - calls other Reconcile or AllReconcile actions as needed based on what is provided in the Dto
  - never triggers an external call, because its intent is to thoroughly process the data provided in the Dto
- name scheme 
  - named after the relevant Dto
- accepts 
  - a Dto representing the external data
  - a parent Model to attach the target Model to (if applicable)
- throws
  - Exceptions as needed
- returns 
  - the roughly equivalent target Model
### AllReconcile
- purpose
    - uses external data payload representing a group of external objects to create or update or delete internal data that represents the roughly equivalent Models
    - calls Reconcile in a loop, and sometimes AllTrash if it needs to make soft deletes based on the results of the Reconcile actions
    - never triggers an external call, because its intent is to thoroughly process the data provided in the Dto
- name scheme
    - named after the relevant Dto
- accepts
    - a laravel Collection of Dtos representing the external data
    - a parent Model to attach the target Models to (if applicable)
- throws
    - Exceptions as needed
- returns
    - a laravel Collection of the roughly equivalent target Model
### Trash
- purpose
    - soft deletes a Model
- name scheme
    - named after the relevant Model
- accepts
    - a Model
- throws
    - Exceptions as needed
- returns
    - void
### AllTrash
- purpose
    - soft deletes a group of Models
- name scheme
    - named after the relevant Model
- accepts
    - a laravel Collection of Models
- throws
    - Exceptions as needed
- returns
    - void
### Retrieve
- purpose
    - finds the target Model based on an identifier, if it exists
- name scheme
    - named after the relevant Model
- accepts
    - nullable string representing an identifier
- throws
    - Exception if multiple Models with this identifier were found
    - Exceptions as needed
- returns
    - null if representing identifier was null
    - null if no Models with this identifier were found
    - the target Model
### Locate
- purpose
    - finds the target Model based on an identifier
- name scheme
    - named after the relevant Model
- accepts
    - string representing an identifier
- throws
    - Exception if multiple Models with this identifier were found
    - Exception if no Models with this identifier were found
    - Exceptions as needed
- returns
    - the target Model
### Create
### Manifest
