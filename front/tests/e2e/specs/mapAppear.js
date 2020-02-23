describe('Map and markers appears visible', () => {
    it('visit the map URL', () => {
      cy.visit('/map')
      cy.get('.mgl-map-wrapper').should('be.visible')
      cy.get('.mapboxgl-marker').should('be.visible')
    })
  })
  